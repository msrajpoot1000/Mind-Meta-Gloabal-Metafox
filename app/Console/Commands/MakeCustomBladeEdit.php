<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeCustomBladeEdit extends Command
{
    protected $signature = 'make:custom-blade-edit {viewName} {--fields=*}';
    protected $description = 'Generate an edit Blade view with dynamic form fields';

    public function handle()
    {
        $viewName = $this->argument('viewName'); // e.g., program-edit
        $fields = $this->option('fields');

        $modelSlug = Str::before($viewName, '-edit'); // e.g., program
        $routeName = 'admin-' . $modelSlug . '.update'; // e.g., admin-program.update
        $viewPath = resource_path("views/admin/pages/{$viewName}.blade.php");

        if (File::exists($viewPath)) {
            $this->error("Blade view already exists: $viewPath");
            return;
        }

        // Validate and parse fields
        $parsedFields = [];
        foreach ($fields as $field) {
            $parts = explode(':', $field);
            if (count($parts) < 2 || count($parts) > 3) {
                $this->error("Invalid format for field: \"$field\". Use format: type[:inputType]:name");
                return;
            }

            if ($parts[0] === 'input' && count($parts) === 3) {
                $parsedFields[] = [
                    'type' => 'input',
                    'inputType' => $parts[1],
                    'name' => $parts[2],
                ];
            } else {
                $parsedFields[] = [
                    'type' => $parts[0],
                    'inputType' => null,
                    'name' => $parts[1],
                ];
            }
        }

        // Generate field HTML
        $formFields = collect($parsedFields)->map(fn($field) => $this->renderField($field))->implode("\n\n");

        $content = <<<BLADE
@extends('admin.layouts.app')

@section('title', 'Dashboard | Edit Item')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Edit Item</h4>
            </div>
            <div class="card-body">

                <form action="{{ route('$routeName', \$item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    $formFields

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary w-md">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        if (document.querySelector('#description')) {
            ClassicEditor.create(document.querySelector('#description')).catch(error => console.error(error));
        }
        if (document.querySelector('#description2')) {
            ClassicEditor.create(document.querySelector('#description2')).catch(error => console.error(error));
        }

        const fileInput = document.querySelector('input[type="file"]');
        const previewImg = document.getElementById('image_preview1');
        if (fileInput && previewImg) {
            fileInput.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewImg.src = e.target.result;
                        previewImg.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
@endsection
BLADE;

        File::ensureDirectoryExists(dirname($viewPath));
        File::put($viewPath, $content);

        $this->info("Edit Blade view created: $viewPath");
    }

    private function renderField(array $field): string
    {
        $name = $field['name'];
        $label = Str::headline($name);
        $inputClass = "@error('$name') is-invalid @enderror";
        $errorBlock = "@error('$name')<div class=\"invalid-feedback\">{{ \$message }}</div>@enderror";

        if ($field['type'] === 'input' && $field['inputType'] === 'file') {
            return <<<HTML
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="$name" class="form-label">$label</label>
            <input type="file" class="form-control $inputClass" name="$name" id="{$name}1" accept="image/*">
            $errorBlock
        </div>
    </div>
    <div class="col-md-6 d-flex align-items-center justify-content-center">
        <img id="image_preview1" src="{{ asset(\$item->$name) }}" alt="Selected Image" style="max-width: 5rem; border: 1px solid #ccc; padding: 5px;">
    </div>
</div>
HTML;
        }

        if ($field['type'] === 'input') {
            return <<<HTML
<div class="mb-3">
    <label for="$name" class="form-label">$label</label>
    <input type="{$field['inputType']}" name="$name" id="$name" class="form-control $inputClass" value="{{ old('$name', \$item->$name ?? '') }}">
    $errorBlock
</div>
HTML;
        }

        if ($field['type'] === 'textarea') {
            return <<<HTML
<div class="mb-3">
    <label for="$name" class="form-label">$label</label>
    <textarea name="$name" id="$name" class="form-control $inputClass" rows="4">{{ old('$name', \$item->$name ?? '') }}</textarea>
    $errorBlock
</div>
HTML;
        }

        if ($field['type'] === 'select') {
            return <<<HTML
<div class="mb-3">
    <label for="$name" class="form-label">$label</label>
    <select name="$name" id="$name" class="form-select $inputClass">
        <option value="1" {{ old('$name', \$item->$name) == '1' ? 'selected' : '' }}>Active</option>
        <option value="0" {{ old('$name', \$item->$name) == '0' ? 'selected' : '' }}>Inactive</option>
    </select>
    $errorBlock
</div>
HTML;
        }

        return "<!-- Unknown field type: {$field['type']} -->";
    }
}
