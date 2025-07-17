<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeCatCrudController extends Command
{
    protected $signature = 'make:cat-crud {name} {--fields=*}';
    protected $description = 'Create a base category CRUD (Controller, Model, Migration, Seeder, and Routes)';

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
            $parts = explode(':', $field);
            $fields[] = [
                'name' => $parts[0],
                'type' => $parts[1],
                'reference' => $parts[2] ?? null,
            ];
        }

        $controllerPath = app_path("Http/Controllers/{$controllerName}.php");
        if (File::exists($controllerPath)) {
            $this->error("❌ Controller {$controllerName} already exists.");
            return;
        }

        $stub = $this->getControllerStub($fields, $modelName, $snakeSingular, $snakePlural, $routeSlug);
        File::put($controllerPath, $stub);
        $this->info("✅ Controller {$controllerName} created.");

        $this->callSilent('make:model', ['name' => $modelName]);
        $this->info("✅ Model {$modelName} created.");
        $this->updateModelFillable($modelName, $fields);

        $this->callSilent('make:migration', [
            'name' => "create_{$snakePlural}_table",
            '--create' => $snakePlural,
        ]);
        $this->info("✅ Migration for {$snakePlural} created.");

        sleep(1);
        $migrationFiles = File::files(database_path('migrations'));
        $latestMigration = collect($migrationFiles)->sortByDesc(fn($file) => $file->getCTime())->first();

        if ($latestMigration) {
            $path = $latestMigration->getRealPath();
            $content = File::get($path);
            $fieldDefinitions = '';

            foreach ($fields as $field) {
                $name = $field['name'];
                $type = $field['type'];
                if (in_array($type, ['hasMany', 'belongsTo', 'hasOne', 'morphMany', 'morphTo'])) {
                    continue;
                }

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

        $this->callSilent('make:seeder', ['name' => "{$modelName}Seeder"]);
        $this->info("✅ Seeder {$modelName}Seeder created.");
        $this->updateSeederFile($modelName, $fields, $snakePlural);

        $this->appendRoutes($controllerName, $routeSlug, $snakeSingular, $snakePlural);
    }

    protected function updateModelFillable($modelName, $fields)
    {
        $path = app_path("Models/{$modelName}.php");
        if (!File::exists($path)) return;
    
        // Filter only fillable fields (exclude relationship fields)
        $fillable = array_filter($fields, fn($f) =>
            !in_array($f['type'], ['hasMany', 'belongsTo', 'hasOne', 'morphMany', 'morphTo'])
        );
        $fillable = array_map(fn($f) => "'{$f['name']}'", $fillable);
        $fillableString = implode(', ', $fillable);
    
        // Generate relationship methods
        $relations = '';
        foreach ($fields as $field) {
            $name = $field['name'];
            $type = $field['type'] ?? 'string';
            $relatedModel = $field['reference'] ?? null;
    
            if ($relatedModel && in_array($type, ['hasMany', 'hasOne', 'belongsTo'])) {
                $functionName = match ($type) {
                    'hasMany' => Str::camel(Str::plural($name)), // plural method name
                    default => Str::camel(Str::singular($name)), // singular method name
                };
            
                $relations .= match ($type) {
                    'hasMany' => "\n    public function {$functionName}()\n    {\n        return \$this->hasMany({$relatedModel}::class);\n    }\n",
                    'hasOne' => "\n    public function {$functionName}()\n    {\n        return \$this->hasOne({$relatedModel}::class);\n    }\n",
                    'belongsTo' => "\n    public function {$functionName}()\n    {\n        return \$this->belongsTo({$relatedModel}::class);\n    }\n",
                    default => ''
                };
            }
            
        }
    
        // Insert into model
        $contents = File::get($path);
        $contents = preg_replace(
            "/class\s+{$modelName}\s+extends\s+Model\s*\{/s",
            "class {$modelName} extends Model {\n    protected \$fillable = [{$fillableString}];{$relations}",
            $contents
        );
    
        File::put($path, $contents);
        $this->info("✅ Model {$modelName} updated with fillable fields and relationships.");
    }
    

    protected function updateSeederFile($modelName, $fields, $snakePlural)
    {
        $seederPath = base_path("database/seeders/{$modelName}Seeder.php");
        if (!File::exists($seederPath)) return;

        $content = File::get($seederPath);
        if (!str_contains($content, 'use Illuminate\\Support\\Facades\\DB;')) {
            $content = preg_replace(
                '/namespace Database\\\\Seeders;/',
                "namespace Database\\Seeders;\n\nuse Illuminate\\Support\\Facades\\DB;",
                $content
            );
        }

        $lines = [];
        foreach ($fields as $field) {
            if (in_array($field['type'], ['hasMany', 'belongsTo', 'hasOne', 'morphMany', 'morphTo'])) continue;

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

    protected function appendRoutes($controllerName, $routeSlug, $snakeSingular, $snakePlural)
    {
        $routePath = base_path('routes/web.php');
        $routeStub = <<<ROUTE

// {$controllerName}
use App\Http\Controllers\\{$controllerName};
Route::get('/{$routeSlug}', [{$controllerName}::class, 'indexF'])->name('user.pages.{$snakeSingular}');
Route::resource('admin-{$snakePlural}', {$controllerName}::class)->middleware(['auth', 'verified']);

ROUTE;
        File::append($routePath, $routeStub);
        $this->info("✅ Routes added to web.php.");
    }

   protected function getControllerStub($fields, $modelName, $snakeSingular, $snakePlural, $routeSlug)
{
    $rules = [];
    $imageFields = [];
    $nonImageFields = [];

    foreach ($fields as $field) {
        if (in_array($field['type'], ['hasMany', 'belongsTo', 'hasOne', 'morphMany', 'morphTo'])) continue;

        $name = $field['name'];
        $type = $field['type'];

        if ($type === 'image') {
            $imageFields[] = $name;
        } else {
            $nonImageFields[] = $name;
        }

        $rule = match ($type) {
            'string', 'text' => "'{$name}' => 'required|string'",
            'boolean' => "'{$name}' => 'boolean'",
            'integer' => "'{$name}' => 'required|integer'",
            'date' => "'{$name}' => 'required|date'",
            'image' => "'{$name}' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'",
            default => "'{$name}' => 'nullable'"
        };

        $rules[] = $rule;
    }

    $validation = implode(",\n        ", $rules);
    $onlyFields = array_merge($nonImageFields);

    
    $uploadStore = '';
    foreach ($imageFields as $name) {
        $uploadStore .= <<<PHP

        if (\$request->hasFile('{$name}')) {
            \$folder = 'upload/{$snakePlural}';
            \$path = public_path(\$folder);
            if (!file_exists(\$path)) {
                mkdir(\$path, 0777, true);
            }
            \$file = \$request->file('{$name}');
            \$filename = uniqid() . '.' . \$file->getClientOriginalExtension();
            \$file->move(\$path, \$filename);
            \$data['{$name}'] = \$folder . '/' . \$filename;
        }
PHP;
    }

   $photoArrayString = "'" . implode("', '", $imageFields) . "'";
   $uploadUpdate = <<<PHP
        \$photoFields = [{$photoArrayString}];

        foreach (\$photoFields as \$field) {
            \$statusField = 'status_' . \$field;

            if (\$request->input(\$statusField)) {
                if (\$request->hasFile(\$field)) {
                    if (!empty(\$item->\$field) && file_exists(public_path(\$item->\$field))) {
                        unlink(public_path(\$item->\$field));
                    }

                    \$folder = 'upload/{$snakePlural}';
                    \$path = public_path(\$folder);
                    if (!file_exists(\$path)) {
                        mkdir(\$path, 0777, true);
                    }

                    \$file = \$request->file(\$field);
                    \$filename = uniqid() . '.' . \$file->getClientOriginalExtension();
                    \$file->move(\$path, \$filename);

                    \$data[\$field] = \$folder . '/' . \$filename;
                } else {
                    \$data[\$field] = \$item->\$field;
                }
            } else {
                if (!empty(\$item->\$field) && file_exists(public_path(\$item->\$field))) {
                    unlink(public_path(\$item->\$field));
                }

                \$data[\$field] = null;
            }
        }
PHP;


    $onlyArray = implode("', '", $onlyFields);

    return <<<PHP
<?php

namespace App\Http\Controllers;

use App\Models\\{$modelName};
use Illuminate\Http\Request;

class {$modelName}Controller extends Controller
{
    public function indexF()
    {
        return view('user.pages.{$snakePlural}');
    }

    public function index()
    {
        \$items = {$modelName}::latest()->get();
        return view('admin.pages.{$snakePlural}', compact('items'));
    }

    public function create() {}

    public function store(Request \$request)
    {
        \$data = \$request->validate([
            {$validation}
        ]);
        {$uploadStore}

        {$modelName}::create(\$data);
        return redirect()->route('admin-{$snakePlural}.index')->with('success', '{$modelName} created successfully.');
    }

    public function edit(string \$id)
    {
        \$item = {$modelName}::findOrFail(\$id);
        return view('admin.pages.{$snakePlural}-edit', compact('item'));
    }

    public function update(Request \$request, string \$id)
    {
        \$item = {$modelName}::findOrFail(\$id);

        \$request->validate([
            {$validation}
        ]);

        \$data = \$request->only(['{$onlyArray}']);

        {$uploadUpdate}


        \$item->update(\$data);

        return redirect()->route('admin-{$snakePlural}.index')->with('success', '{$modelName} updated successfully.');
    }

        public function destroy(string \$id)
        {
            \$item = {$modelName}::findOrFail(\$id);
    
            // Delete image file(s)
            if (\$item->photo && file_exists(public_path(\$item->photo))) {
                unlink(public_path(\$item->photo));
            }
    
            if (\$item->photo2 && file_exists(public_path(\$item->photo2))) {
                unlink(public_path(\$item->photo2));
            }
    
            \$item->delete();
    
            return redirect()->route('admin-{$snakePlural}.index')->with('success', '{$modelName} deleted successfully.');
    }
}
PHP;
}

    
}
