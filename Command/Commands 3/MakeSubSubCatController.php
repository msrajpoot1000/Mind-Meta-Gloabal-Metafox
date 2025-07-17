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

        $stub = $this->getControllerStub($fields, $modelName, $kebabPlural);
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

        $this->appendRoutes($controllerName, $kebabPlural, $fieldsInput);
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

        $fillable = array_map(
            fn($f) => "'{$f['name']}'",
            array_filter($fields, fn($f) => $f['type'] !== 'hasMany')
        );
        $fillableString = implode(', ', $fillable);

        $relations = '';
        $hasSubRelation = false;

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

                if (Str::startsWith($modelRef, 'Sub')) {
                    $hasSubRelation = true;
                    $parentModel = Str::replaceFirst('Sub', '', $modelRef);
                    $relations .= <<<REL

    public function {$parentModel}()
    {
        return \$this->{$method}?->{$parentModel};
    }
REL;
                }
            }
        }

        $content = <<<MODEL
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class {$modelName} extends Model
{
    protected \$fillable = [{$fillableString}];
    {$relations}
}
MODEL;

        File::put($modelPath, $content);
    }

    protected function appendRoutes($controllerName, $kebabPlural, $fieldsInput)
    {
        $routePath = base_path('routes/web.php');

        $refModel = null;
        foreach ($fieldsInput as $field) {
            if (Str::contains($field, 'ref_id:belongsTo:')) {
                $refModel = Str::after($field, 'ref_id:belongsTo:');
                break;
            }
        }

        $mainModel = $refModel && Str::startsWith($refModel, 'Sub')
            ? Str::replaceFirst('Sub', '', $refModel)
            : null;

        $subSlug = $refModel ? Str::kebab(Str::plural($refModel)) : 'sub-items';
        $mainSlug = $mainModel ? Str::kebab(Str::plural($mainModel)) : 'main';

        $ajaxRoute = '';
        if ($refModel && $mainModel) {
            $ajaxRoute = <<<ROUTE
// Dynamic dependent dropdown route
Route::get('/get-{$subSlug}/{{$mainSlug}Id}', function (\$${mainSlug}Id) {
    return \App\Models\\{$refModel}::where('ref_id', \$${mainSlug}Id)->get(['id', 'name']);
});
ROUTE;
        }

        $stub = <<<ROUTE

// {$controllerName}
use App\Http\Controllers\\{$controllerName};
Route::get('/{$kebabPlural}', [{$controllerName}::class, 'indexF'])->name('user.pages.{$kebabPlural}');
Route::resource('admin-{$kebabPlural}', {$controllerName}::class)->middleware(['auth', 'verified']);
{$ajaxRoute}

ROUTE;

        File::append($routePath, $stub);
        $this->info("✅ Routes added to web.php.");
    }

   protected function getControllerStub(array $fields, string $modelName, string $kebabPlural): string
{
    $imageFields = [];
    $rules = [];

    $refModel = null;
    foreach ($fields as $field) {
        if ($field['type'] === 'image') {
            $imageFields[] = $field['name'];
        }

        if ($field['type'] === 'belongsTo') {
            $refModel = $field['reference'];
        }

        $rule = match ($field['type']) {
            'string', 'text' => "'{$field['name']}' => 'required|string'",
            'boolean' => "'{$field['name']}' => 'boolean'",
            'image' => "'{$field['name']}' => 'nullable|image|mimes:jpg,jpeg,png'",
            'belongsTo' => "'{$field['name']}' => 'required|exists:" . Str::snake(Str::pluralStudly($field['reference'])) . ",id'",
            default => "'{$field['name']}' => 'nullable'",
        };
        $rules[] = $rule;
    }

    $validation = implode(",\n            ", $rules);

    $refModelUse = $refModel ? "use App\Models\\{$refModel};" : '';
    $uses = "use App\Models\\{$modelName};\nuse Illuminate\Http\Request;\n{$refModelUse}";

    // Infer first-level model (e.g., from SubProduct => Product)
    $firstLevelModel = $refModel && Str::startsWith($refModel, 'Sub') ? Str::replaceFirst('Sub', '', $refModel) : null;
    $firstLevelUse = $firstLevelModel ? "use App\Models\\{$firstLevelModel};" : '';
    $uses .= $firstLevelModel ? "\n{$firstLevelUse}" : '';

    $imageStore = '';
    foreach ($imageFields as $img) {
        $imageStore .= <<<CODE

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
CODE;
    }

    $imageUpdate = '';
    foreach ($imageFields as $img) {
        $imageUpdate .= <<<CODE

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
CODE;
    }

    // View compact variables
    $viewCompactVars = $firstLevelModel
        ? "'items1', 'items3'"
        : "'items3'";

    $editCompactVars = $firstLevelModel
        ? "'items1', 'item3', 'item2Id', 'item1Id'"
        : "'item3'";

    // Index $items1
    $items1Fetch = $firstLevelModel
        ? "\$items1 = {$firstLevelModel}::all();"
        : "// No parent items";

    // SubProgram + Program inference
    $withRelations = $refModel
        ? "->with(['{$refModel}', '{$refModel}." . lcfirst($firstLevelModel) . "'])"
        : '';

    $editRefs = '';
    if ($refModel && $firstLevelModel) {
        $editRefs = <<<PHP
        \$subModel = {$refModel}::find(\$item3->ref_id);
        \$mainModel = \$subModel ? {$firstLevelModel}::find(\$subModel->ref_id) : null;
        \$item2Id = \$subModel?->id;
        \$item1Id = \$mainModel?->id;
PHP;
    }

    return <<<PHP
<?php

namespace App\Http\Controllers;

{$uses}

class {$modelName}Controller extends Controller
{
    public function index()
    {
        {$items1Fetch}
        \$items3 = {$modelName}::query(){$withRelations}->get();
        return view('admin.pages.{$kebabPlural}', compact({$viewCompactVars}));
    }

    public function store(Request \$request)
    {
        \$data = \$request->validate([
            {$validation}
        ]);{$imageStore}

        {$modelName}::create(\$data);
        return redirect()->route('admin-{$kebabPlural}.index')->with('success', '{$modelName} created successfully.');
    }

    public function edit(string \$id)
    {
        {$items1Fetch}
        \$item3 = {$modelName}::findOrFail(\$id);
        {$editRefs}

        return view('admin.pages.{$kebabPlural}-edit', compact({$editCompactVars}));
    }

    public function update(Request \$request, string \$id)
    {
        \$item = {$modelName}::findOrFail(\$id);
        \$data = \$request->validate([
            {$validation}
        ]);{$imageUpdate}

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
