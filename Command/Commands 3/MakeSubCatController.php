<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeSubCatController extends Command
{
    protected $signature = 'make:subcat-crud {name} {--fields=*}';
    protected $description = 'Create a subcategory CRUD (Controller, Model, Migration, Seeder, Routes)';

    public function handle()
    {
        $baseName = $this->argument('name');
        $controllerName = $baseName . 'Controller';
        $modelName = $baseName;
        $snakePlural = Str::plural(Str::snake($modelName));
        $kebabPlural = Str::kebab(Str::plural($modelName)); // sub-categories

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

        // Controller
        $controllerPath = app_path("Http/Controllers/{$controllerName}.php");
        if (File::exists($controllerPath)) {
            $this->error("❌ Controller {$controllerName} already exists.");
            return;
        }

        $stub = $this->getControllerStub($fields, $modelName, $kebabPlural, $snakePlural);
        File::put($controllerPath, $stub);
        $this->info("✅ Controller {$controllerName} created.");

        // Model
        $this->callSilent('make:model', ['name' => $modelName]);
        $this->updateModel($modelName, $fields);
        $this->info("✅ Model {$modelName} created and updated.");

        // Migration
        $this->callSilent('make:migration', [
            'name' => "create_{$snakePlural}_table",
            '--create' => $snakePlural,
        ]);
        $this->injectMigrationFields($snakePlural, $fields);
        $this->info("✅ Migration created and updated.");

        // Seeder
        $this->callSilent('make:seeder', ['name' => "{$modelName}Seeder"]);
        $this->info("✅ Seeder {$modelName}Seeder created.");

        // Route
        $this->appendRoutes($controllerName, $kebabPlural);
    }

    protected function injectMigrationFields($snakePlural, $fields)
    {
        $migrationFiles = File::files(database_path('migrations'));
        $latest = collect($migrationFiles)->sortByDesc(fn($f) => $f->getCTime())->first();

        if (!$latest) return;
        $path = $latest->getRealPath();
        $content = File::get($path);
        $fieldDefs = '';

        foreach ($fields as $field) {
            $name = $field['name'];
            $type = $field['type'];
            $ref = $field['reference'];

            if ($type === 'belongsTo' && $ref) {
                $refTable = Str::snake(Str::pluralStudly($ref));
                $fieldDefs .= "            \$table->foreignId('{$name}')->constrained('{$refTable}')->onDelete('cascade');\n";
            } else {
                $map = match ($type) {
                    'string', 'image' => "string('{$name}')->nullable()",
                    'text' => "text('{$name}')->nullable()",
                    'boolean' => "boolean('{$name}')->default(true)",
                    'integer' => "integer('{$name}')->nullable()",
                    'date' => "date('{$name}')->nullable()",
                    default => "{$type}('{$name}')->nullable()"
                };
                $fieldDefs .= "            \$table->{$map};\n";
            }
        }

        $content = preg_replace('/(\$table->id\(\);\s*)/', "$1\n$fieldDefs", $content);
        File::put($path, $content);
    }

    protected function updateModel($modelName, $fields)
    {
        $modelPath = app_path("Models/{$modelName}.php");
        if (!File::exists($modelPath)) return;

        $fillable = array_map(fn($f) => "'{$f['name']}'", array_filter($fields, fn($f) => $f['type'] !== 'hasMany'));
        $fillableString = implode(', ', $fillable);

        $relations = '';
        foreach ($fields as $field) {
            if ($field['type'] === 'belongsTo' && $field['reference']) {
                $method = Str::camel(Str::singular($field['reference']));
                $modelRef = Str::studly($field['reference']);
                $relations .= "\n    public function {$method}()\n    {\n        return \$this->belongsTo({$modelRef}::class, '{$field['name']}');\n    }\n";
            }
        }

        $relations .= "\n    public function subCategories()\n    {\n        return \$this->hasMany({$modelName}::class, 'ref_id');\n    }\n";

        $content = <<<MODEL
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class {$modelName} extends Model
{
    protected \$fillable = [{$fillableString}];{$relations}
}
MODEL;

        File::put($modelPath, $content);
    }

    protected function appendRoutes($controllerName, $kebabPlural)
    {
        $routePath = base_path('routes/web.php');
        $stub = <<<ROUTE

// {$controllerName}
use App\Http\Controllers\\{$controllerName};
Route::get('/{$kebabPlural}', [{$controllerName}::class, 'indexF'])->name('user.pages.{$kebabPlural}');
Route::resource('admin-{$kebabPlural}', {$controllerName}::class)->middleware(['auth', 'verified']);

ROUTE;

        File::append($routePath, $stub);
        $this->info("✅ Routes added to web.php.");
    }

    protected function getControllerStub($fields, $modelName, $kebabPlural, $snakePlural)
    {
        $rules = [];
        $imageFields = [];
        $relatedModel = null;
        $relationMethod = null;

        foreach ($fields as $f) {
            if ($f['type'] === 'belongsTo' && $f['reference']) {
                $relatedModel = Str::studly($f['reference']);
                $relationMethod = Str::camel($f['reference']);
            }

            if ($f['type'] === 'image') {
                $imageFields[] = $f['name'];
            }

            $rule = match ($f['type']) {
                'string', 'text' => "'{$f['name']}' => 'required|string'",
                'boolean' => "'{$f['name']}' => 'boolean'",
                'integer' => "'{$f['name']}' => 'required|integer'",
                'date' => "'{$f['name']}' => 'required|date'",
                'image' => "'{$f['name']}' => 'nullable|image|mimes:jpg,jpeg,png'",
                'belongsTo' => "'{$f['name']}' => 'required|exists:" . Str::snake(Str::pluralStudly($f['reference'])) . ",id'",
                default => "'{$f['name']}' => 'nullable'"
            };
            $rules[] = $rule;
        }

        $validation = implode(",\n            ", $rules);

        $uses = "use App\Models\\{$modelName};\nuse Illuminate\Http\Request;";
        if ($relatedModel) {
            $uses .= "\nuse App\Models\\{$relatedModel};";
        }

        $imageStoreCode = '';
        foreach ($imageFields as $img) {
            $imageStoreCode .= <<<IMG

        if (\$request->hasFile('{$img}')) {
            \$folder = 'upload/categories';
            \$path = public_path(\$folder);
            if (!file_exists(\$path)) {
                mkdir(\$path, 0777, true);
            }
            \$file = \$request->file('{$img}');
            \$filename = uniqid() . '.' . \$file->getClientOriginalExtension();
            \$file->move(\$path, \$filename);
            \$data['{$img}'] = \$folder . '/' . \$filename;
        }
IMG;
        }

        $imageUpdateCode = '';
        foreach ($imageFields as $img) {
            $imageUpdateCode .= <<<IMG

        if (\$request->hasFile('{$img}')) {
            if (!empty(\$item->{$img}) && file_exists(public_path(\$item->{$img}))) {
                unlink(public_path(\$item->{$img}));
            }
            \$folder = 'upload/categories';
            \$path = public_path(\$folder);
            if (!file_exists(\$path)) {
                mkdir(\$path, 0777, true);
            }
            \$file = \$request->file('{$img}');
            \$filename = uniqid() . '.' . \$file->getClientOriginalExtension();
            \$file->move(\$path, \$filename);
            \$data['{$img}'] = \$folder . '/' . \$filename;
        }
IMG;
        }

        $index = $relatedModel ? "\$items1 = {$relatedModel}::get();\n        \$items2 = {$modelName}::with('{$relationMethod}')->latest()->get();\n        return view('admin.pages.{$kebabPlural}', compact('items1', 'items2'));" : "\$items2 = {$modelName}::latest()->get();\n        return view('admin.pages.{$kebabPlural}', compact('items2'));" ;

        $edit = $relatedModel ? "\$items1 = {$relatedModel}::get();\n        \$item2 = {$modelName}::findOrFail(\$id);\n        return view('admin.pages.{$kebabPlural}-edit', compact('items1', 'item2'));" : "\$items2 = {$modelName}::findOrFail(\$id);\n        return view('admin.pages.{$kebabPlural}-edit', compact('items2'));" ;

        return <<<PHP
<?php

namespace App\Http\Controllers;

{$uses}

class {$modelName}Controller extends Controller
{
    public function index()
    {
        {$index}
    }

    public function store(Request \$request)
    {
        \$data = \$request->validate([
            {$validation}
        ]);{$imageStoreCode}

        {$modelName}::create(\$data);
        return redirect()->route('admin-{$kebabPlural}.index')->with('success', '{$modelName} created successfully.');
    }

    public function edit(string \$id)
    {
        {$edit}
    }

    public function update(Request \$request, string \$id)
    {
        \$item = {$modelName}::findOrFail(\$id);
        \$data = \$request->validate([
            {$validation}
        ]);{$imageUpdateCode}

        \$item->update(\$data);
        return redirect()->route('admin-{$kebabPlural}.index')->with('success', '{$modelName} updated successfully.');
    }

    public function destroy(string \$id)
    {
        \$item = {$modelName}::findOrFail(\$id);
        \$item->delete();
        return redirect()->route('admin-{$kebabPlural}.index')->with('success', '{$modelName} deleted successfully.');
    }

    public function indexF()
    {
        return view('user.pages.{$kebabPlural}');
    }
}
PHP;
    }
}
