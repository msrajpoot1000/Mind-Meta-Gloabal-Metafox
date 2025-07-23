<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeCrudController extends Command
{
    protected $signature = 'make:crud {name} {--fields=*}';
    protected $description = 'Create a CRUD Controller, Model, Migration, Seeder, Routes, and Views dynamically';

    public function handle()
    {
        $baseName = $this->argument('name');
        $controllerName = $baseName . 'Controller';
        $modelName = $baseName;
        $snakeSingular = Str::snake($modelName);
        $snakePlural = Str::plural($snakeSingular);
        $routeSlug = Str::kebab($modelName);

        $fieldsInput = $this->option('fields');
        $fields = [];
        foreach ($fieldsInput as $field) {
            [$name, $type] = explode(':', $field);
            $fields[] = ['name' => $name, 'type' => $type];
        }

        // Controller
        $controllerPath = app_path("Http/Controllers/{$controllerName}.php");
        if (File::exists($controllerPath)) {
            $this->error("❌ Controller {$controllerName} already exists.");
            return;
        }

        $stub = $this->getControllerStub($fields, $modelName, $snakeSingular, $snakePlural, $routeSlug);
        File::put($controllerPath, $stub);
        $this->info("✅ Controller {$controllerName} created.");

        // Model
        $this->callSilent('make:model', ['name' => $modelName]);
        $this->info("✅ Model {$modelName} created.");
        $this->updateModelFillable($modelName, $fields);

        // Migration
        $this->callSilent('make:migration', [
            'name' => "create_{$snakePlural}_table",
            '--create' => $snakePlural,
        ]);
        $this->info("✅ Migration for {$snakePlural} created.");

        sleep(1); // Wait for file creation
        $migrationFiles = File::files(database_path('migrations'));
        $latestMigration = collect($migrationFiles)->sortByDesc(fn($file) => $file->getCTime())->first();

        if ($latestMigration) {
            $path = $latestMigration->getRealPath();
            $content = File::get($path);
            $fieldDefinitions = '';

            foreach ($fields as $field) {
                $name = $field['name'];
                $type = $field['type'];
                switch ($type) {
                    case 'string':
                    case 'image':
                        $fieldDefinitions .= "            \$table->string('{$name}')->nullable();\n";
                        break;
                    case 'text':
                        $fieldDefinitions .= "            \$table->text('{$name}')->nullable();\n";
                        break;
                    case 'boolean':
                        $fieldDefinitions .= "            \$table->boolean('{$name}')->default(true);\n";
                        break;
                    case 'integer':
                        $fieldDefinitions .= "            \$table->integer('{$name}')->nullable();\n";
                        break;
                    case 'date':
                        $fieldDefinitions .= "            \$table->date('{$name}')->nullable();\n";
                        break;
                    default:
                        $fieldDefinitions .= "            \$table->{$type}('{$name}')->nullable();\n";
                        break;
                }
            }

            $content = preg_replace('/(\$table->id\(\);\s*)/', "\$table->id();\n{$fieldDefinitions}", $content);
            File::put($path, $content);
            $this->info("✅ Migration fields added.");
        }

        // Seeder
        $this->callSilent('make:seeder', ['name' => "{$modelName}Seeder"]);
        $this->info("✅ Seeder {$modelName}Seeder created.");
        $this->updateSeederFile($modelName, $fields, $snakePlural);

        

        // Routes
        $this->appendRoutes($controllerName, $routeSlug, $snakeSingular);
    }

    protected function updateModelFillable($modelName, $fields)
    {
        $path = app_path("Models/{$modelName}.php");
        if (!File::exists($path)) return;

        $fillable = array_map(fn($f) => "'{$f['name']}'", $fields);
        $fillableString = implode(', ', $fillable);
        $contents = File::get($path);
        $contents = preg_replace(
            "/class\s+{$modelName}\s+extends\s+Model\s*\{/",
            "class {$modelName} extends Model {\n    protected \$fillable = [{$fillableString}];",
            $contents
        );

        File::put($path, $contents);
    }

    protected function updateSeederFile($modelName, $fields, $snakePlural)
    {
        $seederPath = base_path("database/seeders/{$modelName}Seeder.php");
        if (!File::exists($seederPath)) return;

        $content = File::get($seederPath);
        if (!str_contains($content, 'use Illuminate\Support\Facades\DB;')) {
            $content = preg_replace(
                '/namespace Database\\\\Seeders;/',
                "namespace Database\\Seeders;\n\nuse Illuminate\\Support\\Facades\\DB;",
                $content
            );
        }

        $lines = [];
        foreach ($fields as $field) {
            $name = $field['name'];
            $type = $field['type'];
            $lines[] = match ($type) {
                'string', 'text' => "'{$name}' => 'Sample {$name}'",
                'boolean' => "'{$name}' => true",
                'integer' => "'{$name}' => 1",
                'date' => "'{$name}' => now()->toDateString()",
                'image' => "'{$name}' => 'upload/{$snakePlural}/sample.jpg'",
                default => "'{$name}' => null"
            };
        }
        $lines[] = "'created_at' => now()";
        $lines[] = "'updated_at' => now()";
        $block = implode(",\n                ", $lines);

        $data = <<<PHP

        DB::table('{$snakePlural}')->insert([
            [
                {$block}
            ]
        ]);

PHP;
        $content = str_replace('    }', $data . '    }', $content);
        File::put($seederPath, $content);
        $this->info("✅ Seeder filled with sample data.");
    }

    protected function appendRoutes($controllerName, $routeSlug, $snakeSingular)
    {
        $routePath = base_path('routes/web.php');
        $routeStub = <<<ROUTE

// {$controllerName}
use App\Http\Controllers\\{$controllerName};
Route::get('/{$routeSlug}', [{$controllerName}::class, 'indexF'])->name('user.pages.{$snakeSingular}');
Route::resource('admin-{$routeSlug}', {$controllerName}::class)->middleware(['auth', 'verified']);

ROUTE;
        File::append($routePath, $routeStub);
        $this->info("✅ Routes added to web.php.");
    }

    protected function getControllerStub($fields, $modelName, $snakeSingular, $snakePlural, $routeSlug)
    {
        $validation = [];
        $onlyFields = [];
        $photoStore = '';
        $photoDelete = '';

        foreach ($fields as $field) {
            $name = $field['name'];
            $type = $field['type'];
            $onlyFields[] = "'{$name}'";

            if ($type === 'image') {
                $validation[] = "'{$name}' => 'nullable|image|max:2048'";
                $photoStore = <<<PHOTO
        if (\$request->hasFile('{$name}')) {
            \$folder = 'upload/{$snakePlural}';
            \$path = public_path(\$folder);
            if (!file_exists(\$path)) mkdir(\$path, 0777, true);
            \$file = \$request->file('{$name}');
            \$filename = uniqid() . '.' . \$file->getClientOriginalExtension();
            \$file->move(\$path, \$filename);
            \$data['{$name}'] = \$folder . '/' . \$filename;
        }
PHOTO;
                $photoDelete = <<<DELETE
        if (\$item->{$name} && file_exists(public_path(\$item->{$name}))) {
            unlink(public_path(\$item->{$name}));
        }
DELETE;
            } else {
                $rule = match ($type) {
                    'string', 'text' => "'{$name}' => 'required|string|max:255'",
                    'boolean' => "'{$name}' => 'nullable|boolean'",
                    'integer' => "'{$name}' => 'nullable|integer'",
                    'date' => "'{$name}' => 'nullable|date'",
                    default => "'{$name}' => 'nullable'"
                };
                $validation[] = $rule;
            }
        }

        $validationString = implode(",\n            ", $validation);
        $only = implode(', ', $onlyFields);

        return <<<EOT
<?php

namespace App\Http\Controllers;

use App\Models\\{$modelName};
use Illuminate\Http\Request;

class {$modelName}Controller extends Controller
{
    public function indexF()
    {
        return view('user.pages.{$snakeSingular}');
    }

    public function index()
    {
        \$items = {$modelName}::latest()->get();
        return view('admin.pages.{$snakeSingular}', compact('items'));
    }

    public function create() {}

    public function store(Request \$request)
    {
        \$request->validate([
            {$validationString}
        ]);

        \$data = \$request->only([{$only}]);
{$photoStore}
        {$modelName}::create(\$data);

        return redirect()->route('admin-{$routeSlug}.index')->with('success', '{$modelName} added successfully!');
    }

    public function show(string \$id) {}

    public function edit(string \$id)
    {
        \$item = {$modelName}::findOrFail(\$id);
        return view('admin.pages.{$snakeSingular}-edit', compact('item'));
    }

  public function update(Request \$request, string \$id)
{
    \$item = {$modelName}::findOrFail(\$id);

    \$request->validate([
        {$validationString}
    ]);

    \$data = \$request->only([{$only}]);

    if (\$request->hasFile('photo')) {
        \$folder = 'upload/{$snakePlural}';
        \$path = public_path(\$folder);

        // Delete old photo if exists
        if (\$item->photo && file_exists(public_path(\$item->photo))) {
            unlink(public_path(\$item->photo));
        }

        // Create folder if not exists
        if (!file_exists(\$path)) {
            mkdir(\$path, 0777, true);
        }

        // Save new photo
        \$file = \$request->file('photo');
        \$filename = uniqid() . '.' . \$file->getClientOriginalExtension();
        \$file->move(\$path, \$filename);

        \$data['photo'] = \$folder . '/' . \$filename;
    }

    \$item->update(\$data);

    return redirect()->route('admin-{$routeSlug}.index')->with('success', '{$modelName} updated successfully!');
}


    public function destroy(string \$id)
    {
        \$item = {$modelName}::findOrFail(\$id);
{$photoDelete}
        \$item->delete();

        return redirect()->route('admin-{$routeSlug}.index')->with('success', '{$modelName} deleted successfully!');
    }
}
EOT;
    }
}
