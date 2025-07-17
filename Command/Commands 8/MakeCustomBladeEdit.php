<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeCustomBladeEdit extends Command
{
    protected $signature = 'make:custom-blade-edit {viewName} {--fields=*}';
    protected $description = 'Generate an edit Blade view with dynamic form fields';

    private int $fileCounter = 0;
    private int $textareaCounter = 0;

    public function handle()
    {
        $viewName = $this->argument('viewName');
        $fields = $this->option('fields');

        $modelSlug = Str::before($viewName, '-edit');
        $routeName = 'admin-' . $modelSlug . '.update';
        $viewPath = resource_path("views/admin/pages/{$viewName}.blade.php");

        if (File::exists($viewPath)) {
            $this->error("Blade view already exists: $viewPath");
            return;
        }

        $parsedFields = [];

        foreach ($fields as $field) {
            $parts = explode(':', $field);
            if (count($parts) < 3) {
                $this->error("Invalid format for field: \"$field\". Use format: type[:inputType]:name[:options]");
                return;
            }

            $fieldData = [
                'type' => $parts[0],
                'inputType' => $parts[0] === 'input' ? $parts[1] : null,
                'name' => $parts[$parts[0] === 'input' ? 2 : 1],
                'required' => false,
                'default' => null,
            ];

            $lastPart = end($parts);

            if (str_contains($lastPart, 'required')) {
                $fieldData['required'] = true;
            }

            if (str_contains($lastPart, 'default=')) {
                preg_match('/default=([^\s]+)/', $lastPart, $matches);
                $fieldData['default'] = $matches[1] ?? null;
            }

            $parsedFields[] = $fieldData;
        }

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
            @if (\$errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach (\$errors->all() as \$error)
                                    <li>{{ \$error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
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
    $requiredSpan = $field['required'] ? '<span class="text-danger">*</span>' : '';
    $default = $field['default'] ?? '';

    if ($field['type'] === 'input' && $field['inputType'] === 'file') {
        $this->fileCounter++;
        $previewId = "photo_preview_$name";

        return <<<HTML
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="$name" class="form-label">$label $requiredSpan</label>
            <input type="file" class="form-control preview-image-input $inputClass" name="$name" id="$name" data-preview-id="$previewId" accept="image/*">
            $errorBlock
        </div>
    </div>

    <div class="col-md-6 d-flex align-items-center justify-content-center">
        <img id="$previewId" src="{{ asset(\$item->$name) }}" alt="No Image" style="max-width: 5rem; border: 1px solid #ccc; padding: 5px;">
<input type="hidden" name="status_{$name}" id="status_{$name}" value="{{ \$item->$name ? 1 : 0 }}">
        <button type="button" id="statusPhotoBtn_{$name}" class="btn btn-danger btn-sm m-2">
            <i class="fas fa-trash"></i> Delete Image
        </button>
    </div>
</div>
HTML;
    }

    if ($field['type'] === 'input') {
        return <<<HTML
<div class="mb-3">
    <label for="$name" class="form-label">$label $requiredSpan</label>
    <input type="{$field['inputType']}" name="$name" id="$name" class="form-control $inputClass" value="{{ old('$name', \$item->$name ?? '$default') }}">
    $errorBlock
</div>
HTML;
    }

    if ($field['type'] === 'textarea') {
        // Use the name itself (e.g., description1) as the ID
        $textareaId = $name;

        return <<<HTML
<div class="mb-3">
    <label for="$textareaId" class="form-label">$label $requiredSpan</label>
    <textarea name="$name" id="$textareaId" class="form-control $inputClass" rows="4">{{ old('$name', \$item->$name ?? '') }}</textarea>
    $errorBlock
</div>
HTML;
    }

    if ($field['type'] === 'select') {
        $defaultOption = $default !== '' ? $default : '1';

        return <<<HTML
<div class="mb-3">
    <label for="$name" class="form-label">$label $requiredSpan</label>
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
