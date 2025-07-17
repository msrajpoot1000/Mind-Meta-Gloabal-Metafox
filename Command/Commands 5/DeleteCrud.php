<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class DeleteCrud extends Command
{
    protected $signature = 'delete:crud {name}';
    protected $description = 'Delete CRUD files: Controller, Model, Seeder, Blade views, migration, and drop the table';

    public function handle()
    {
        $name = Str::studly($this->argument('name'));
        $snakePlural = Str::plural(Str::snake($name));
        $kebabPlural = Str::kebab(Str::plural($name)); // e.g., SubCategory → sub-categories

        // 1. Delete Controller
        $controllerPath = app_path("Http/Controllers/{$name}Controller.php");
        if (File::exists($controllerPath)) {
            File::delete($controllerPath);
            $this->info("✅ Controller deleted: {$name}Controller");
        } else {
            $this->warn("⚠️ Controller not found: {$name}Controller");
        }

        // 2. Delete Model
        $modelPath = app_path("Models/{$name}.php");
        if (File::exists($modelPath)) {
            File::delete($modelPath);
            $this->info("✅ Model deleted: {$name}");
        } else {
            $this->warn("⚠️ Model not found: {$name}");
        }

        // 3. Delete Seeder
        $seederPath = database_path("seeders/{$name}Seeder.php");
        if (File::exists($seederPath)) {
            File::delete($seederPath);
            $this->info("✅ Seeder deleted: {$name}Seeder");
        } else {
            $this->warn("⚠️ Seeder not found: {$name}Seeder");
        }

        // 4. Drop Table
        if (Schema::hasTable($snakePlural)) {
            Schema::drop($snakePlural);
            $this->info("✅ Table dropped: {$snakePlural}");
        } else {
            $this->warn("⚠️ Table not found: {$snakePlural}");
        }

        // 5. Delete Migration
        $migrationFiles = File::files(database_path('migrations'));
        foreach ($migrationFiles as $file) {
            if (str_contains($file->getFilename(), "create_{$snakePlural}_table")) {
                File::delete($file->getRealPath());
                $this->info("✅ Migration file deleted: " . $file->getFilename());
                break;
            }
        }

        // 6. Delete Blade Files
        $bladePath = resource_path("views/admin/pages/{$kebabPlural}.blade.php");
        $editBladePath = resource_path("views/admin/pages/{$kebabPlural}-edit.blade.php");

        if (File::exists($bladePath)) {
            File::delete($bladePath);
            $this->info("✅ Blade view deleted: {$kebabPlural}.blade.php");
        } else {
            $this->warn("⚠️ Blade view not found: {$kebabPlural}.blade.php");
        }

        if (File::exists($editBladePath)) {
            File::delete($editBladePath);
            $this->info("✅ Edit Blade view deleted: {$kebabPlural}-edit.blade.php");
        } else {
            $this->warn("⚠️ Edit Blade view not found: {$kebabPlural}-edit.blade.php");
        }

        $this->info("🎉 Delete CRUD process completed.");
    }
}
