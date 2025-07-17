<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeSubSubCatController extends Command
{
  protected $signature = 'make:subsubcat-crud {name} {--fields=*}';
    protected $description = 'Create a sub-sub-category CRUD (Controller, Model, Migration, Seeder, Routes)';

     public function handle()
    {
        $baseName = $this->argument('name');
        $controllerName = $baseName . 'Controller';
        $modelName = $baseName;
        $snakePlural = Str::plural(Str::snake($modelName));
        $kebabPlural = Str::kebab(Str::plural($modelName));

        $fieldsInput = $this->option('fields');
        $fields = [];
        $belongsToFields = [];

       foreach ($fieldsInput as $field) {
    $parts = explode(':', $field);
    if (count($parts) < 2) continue;

    $meta = [
        'name' => $parts[0],
        'type' => $parts[1],
        'reference' => $parts[2] ?? null,
        'required' => false,
        'nullable' => true,
        'default' => null,
    ];

    foreach ($parts as $p) {
        if ($p === 'required') {
            $meta['required'] = true;
            $meta['nullable'] = false;
        } elseif ($p === 'nullable') {
            $meta['required'] = false;
            $meta['nullable'] = true;
        } elseif (Str::startsWith($p, 'default=')) {
            $meta['default'] = Str::after($p, 'default=');
        }
    }

    $fields[] = $meta;

    if ($meta['type'] === 'belongsTo' && $meta['reference']) {
        $belongsToFields[$meta['reference']] = $meta['name'];
    }
}


        $firstLevelModel = array_key_first($belongsToFields);
        $secondLevelModel = array_key_last($belongsToFields);

        $controllerPath = app_path("Http/Controllers/{$controllerName}.php");
        if (File::exists($controllerPath)) {
            $this->error("❌ Controller {$controllerName} already exists.");
            return;
        }

        $stub = $this->getControllerStub($fields, $modelName, $kebabPlural, $firstLevelModel, $secondLevelModel);
        File::put($controllerPath, $stub);
        $this->info("✅ Controller {$controllerName} created.");

        $this->callSilent('make:model', ['name' => $modelName]);
        $this->updateModel($modelName, $fields);
        $this->info("✅ Model {$modelName} created and updated.");

        $this->callSilent('make:migration', [
            'name' => "create_{$snakePlural}_table",
            '--create' => $snakePlural,
        ]);
        $this->injectMigrationFields($snakePlural, $fields);
        $this->info("✅ Migration created and updated.");

        $this->callSilent('make:seeder', ['name' => "{$modelName}Seeder"]);
        $this->info("✅ Seeder {$modelName}Seeder created.");

        $this->appendRoutes($controllerName, $kebabPlural, $firstLevelModel, $secondLevelModel);
    }

    protected function getControllerStub(array $fields, string $modelName, string $kebabPlural, $firstLevelModel, $secondLevelModel): string
{
    $secondRelationName = Str::camel($secondLevelModel);
    $firstRelationName = Str::camel($firstLevelModel);
    $snakePlural = Str::snake(Str::pluralStudly($modelName)); // ✅ fixed missing variable

    $imageFields = [];
    $rules = [];
    $uses = [
        "use App\\Models\\{$modelName};",
        "use Illuminate\\Http\\Request;",
    ];

    if ($firstLevelModel) $uses[] = "use App\\Models\\{$firstLevelModel};";
    if ($secondLevelModel) $uses[] = "use App\\Models\\{$secondLevelModel};";

    $refIdHandled = false;

    foreach ($fields as $field) {
        $name = $field['name'];
        $type = $field['type'];
        $ref = $field['reference'] ?? null;

        if ($type === 'image') {
            $imageFields[] = $name; // ✅ Fix: only string name
        }

        if ($type === 'belongsTo' && $name === 'ref_id') {
            if (!$refIdHandled && $ref === $secondLevelModel) {
                $rules[] = "'ref_id' => 'required|exists:" . Str::snake(Str::pluralStudly($ref)) . ",id'";
                $refIdHandled = true;
            }
            continue;
        }

       $ruleParts = [];

if ($field['required']) {
    $ruleParts[] = 'required';
} else {
    $ruleParts[] = 'nullable';
}

switch ($type) {
    case 'string':
    case 'text':
        $ruleParts[] = 'string';
        break;
    case 'boolean':
        $ruleParts[] = 'boolean';
        break;
    case 'integer':
        $ruleParts[] = 'integer';
        break;
    case 'date':
        $ruleParts[] = 'date';
        break;
    case 'image':
        $ruleParts[] = 'image';
        $ruleParts[] = 'mimes:jpg,jpeg,png';
        $ruleParts[] = 'max:2048';
        break;
    case 'belongsTo':
        if ($ref === $secondLevelModel) {
            $table = Str::snake(Str::pluralStudly($ref));
            $ruleParts = ["required", "exists:{$table},id"];
        }
        break;
}

$rules[] = "'{$name}' => '" . implode('|', $ruleParts) . "'";

    }

    $validation = implode(",\n            ", $rules);

    // Upload store block
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

    // Upload update block
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

    $usesString = implode("\n", $uses);

    return <<<PHP
<?php

namespace App\Http\Controllers;

{$usesString}

class {$modelName}Controller extends Controller
{
    public function index()
    {
        \$items1 = {$firstLevelModel}::all();
        \$items3 = {$modelName}::with('{$secondRelationName}.{$firstRelationName}')->get();

        return view('admin.pages.{$kebabPlural}', compact('items1', 'items3'));
    }

    public function store(Request \$request)
    {
        \$data = \$request->validate([
            {$validation}
        ]);
        {$uploadStore}

        {$modelName}::create(\$data);
        return redirect()->route('admin-{$kebabPlural}.index')->with('success', '{$modelName} created successfully.');
    }

    public function edit(string \$id)
    {
        \$items1 = {$firstLevelModel}::all();
        \$item3 = {$modelName}::findOrFail(\$id);
        \$subModel = {$secondLevelModel}::find(\$item3->ref_id);
        \$mainModel = \$subModel ? {$firstLevelModel}::find(\$subModel->ref_id) : null;
        \$item2Id = \$subModel?->id;
        \$item1Id = \$mainModel?->id;

        return view('admin.pages.{$kebabPlural}-edit', compact('items1', 'item3', 'item2Id', 'item1Id'));
    }

    public function update(Request \$request, string \$id)
    {
        \$item = {$modelName}::findOrFail(\$id);
        \$data = \$request->validate([
            {$validation}
        ]);{$uploadUpdate}

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
  protected function injectMigrationFields($snakePlural, $fields)
{
    $migrationFiles = File::files(database_path('migrations'));
    $latest = collect($migrationFiles)->sortByDesc(fn($f) => $f->getCTime())->first();
    if (!$latest) return;

    $path = $latest->getRealPath();
    $content = File::get($path);
    $fieldDefs = '';

    // Get second-level model (last belongsTo reference)
    $belongsToRefs = array_values(array_filter($fields, fn($f) => $f['type'] === 'belongsTo' && isset($f['reference'])));
    $secondLevelModel = end($belongsToRefs)['reference'] ?? null;

    $belongsToRefs = array_values(array_filter($fields, fn($f) => $f['type'] === 'belongsTo' && isset($f['reference'])));
$secondLevelModel = end($belongsToRefs)['reference'] ?? null;

foreach ($fields as $field) {
    $name = $field['name'];
    $type = $field['type'];
    $ref = $field['reference'] ?? null;
    $nullable = $field['nullable'] ?? true;
    $default = $field['default'];

    if ($type === 'belongsTo') {
        if ($ref !== $secondLevelModel) continue;

        $refTable = Str::snake(Str::pluralStudly($ref));
        $fieldDefs .= "            \$table->foreignId('{$name}')->constrained('{$refTable}')->onDelete('cascade');\n";
    } else {
        $columnType = $type === 'image' ? 'string' : $type;
        $definition = "\$table->{$columnType}('{$name}')";
        if ($nullable) {
            $definition .= "->nullable()";
        }
        if (!is_null($default)) {
            $defaultVal = is_numeric($default) ? $default : "'{$default}'";
            $definition .= "->default({$defaultVal})";
        }
        $fieldDefs .= "            {$definition};\n";
    }
}


    $content = preg_replace('/(\\$table->id\\(\\);\\s*)/', "$1\n$fieldDefs", $content);
    File::put($path, $content);
}



    protected function updateModel($modelName, $fields)
    {
        $modelPath = app_path("Models/{$modelName}.php");
        if (!File::exists($modelPath)) return;

        $fillable = array_map(
            fn($f) => "'{$f['name']}'",
            array_filter($fields, fn($f) => $f['type'] !== 'hasMany')
        );
        $fillableString = implode(', ', $fillable);

        $relations = '';

        foreach ($fields as $field) {
    if ($field['type'] === 'belongsTo' && $field['reference']) {
        $method = Str::camel(Str::singular($field['reference']));
        $modelRef = Str::studly($field['reference']);
        $relations .= <<<REL

    public function {$method}()
    {
        return \$this->belongsTo({$modelRef}::class, '{$field['name']}');
    }
REL;
    }
}


        $content = <<<MODEL
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class {$modelName} extends Model
{
    protected \$fillable = [
        {$fillableString}
    ];{$relations}
}
MODEL;

        File::put($modelPath, $content);
    }

    protected function appendRoutes($controllerName, $kebabPlural, $firstLevelModel, $secondLevelModel)
    {
        $routePath = base_path('routes/web.php');

        $mainSlug = $firstLevelModel ? Str::kebab(Str::plural($firstLevelModel)) : 'main';
        $subSlug = $secondLevelModel ? Str::kebab(Str::plural($secondLevelModel)) : 'sub-items';

        $ajaxRoute = '';
        if ($firstLevelModel && $secondLevelModel) {
            $ajaxRoute = <<<ROUTE

// Dynamic dependent dropdown route
Route::get('/get-{$subSlug}/{{$mainSlug}Id}', function (\${$mainSlug}Id) {
    return \\App\\Models\\{$secondLevelModel}::where('ref_id', \${$mainSlug}Id)->get(['id', 'name']);
});
ROUTE;
        }

        $stub = <<<ROUTE

// {$controllerName}
use App\\Http\\Controllers\\{$controllerName};
Route::get('/{$kebabPlural}', [{$controllerName}::class, 'indexF'])->name('user.pages.{$kebabPlural}');
Route::resource('admin-{$kebabPlural}', {$controllerName}::class)->middleware(['auth', 'verified']);
{$ajaxRoute}

ROUTE;

        File::append($routePath, $stub);
        $this->info("✅ Routes added to web.php.");
    }
}


