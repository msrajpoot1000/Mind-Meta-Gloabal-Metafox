<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeCustomBlade extends Command
{
    protected $signature = 'make:custom-blade {viewName} {--fields=*}';
    protected $description = 'Generate a Blade view with dynamic input fields and table';

    private int $fileInputCounter = 0;
    private int $textareaCounter = 0;

    public function handle()
    {
        $viewName = $this->argument('viewName');
        $fields = $this->option('fields');

        $parsedFields = [];

        foreach ($fields as $field) {
            $parts = explode(':', $field);

            if (count($parts) < 2 || count($parts) > 4) {
                $this->error("Invalid format for field: \"$field\". Use format: type[:inputType]:name[:required|nullable]");
                return;
            }

            $type = $parts[0];
            $inputType = null;
            $name = '';
            $required = false;

            if ($type === 'input') {
                if (count($parts) < 3) {
                    $this->error("For 'input', use format: input:inputType:name[:required|nullable]");
                    return;
                }
                $inputType = $parts[1];
                $name = $parts[2];
                $required = isset($parts[3]) && $parts[3] === 'required';
            } else {
                $name = $parts[1];
                $required = isset($parts[2]) && $parts[2] === 'required';
            }

            $parsedFields[] = [
                'type' => $type,
                'inputType' => $inputType,
                'name' => $name,
                'required' => $required,
            ];
        }

        $viewPath = resource_path("views/admin/pages/{$viewName}.blade.php");

        if (File::exists($viewPath)) {
            $this->error("Blade view already exists: $viewPath");
            return;
        }

        $content = $this->generateBladeView($viewName, $parsedFields);

        File::ensureDirectoryExists(dirname($viewPath));
        File::put($viewPath, $content);

        $this->info("Blade view created: $viewPath");
    }

    private function generateBladeView($viewName, $fields): string
    {
        $fieldsHtml = collect($fields)->map(fn($field) => $this->renderField($field))->implode("\n\n");
        $tableHeaders = collect($fields)->map(fn($field) => "<th>" . $this->label($field['name']) . "</th>")->implode("\n");

        $tableCells = collect($fields)->map(function ($field) {
            $name = $field['name'];

            if ($name === 'is_active') {
                return <<<HTML
<td class="v-center">
    @if (\$item->is_active == 1)
        <span class="badge bg-success">Active</span>
    @elseif (\$item->is_active == 0)
        <span class="badge bg-danger">Inactive</span>
    @else
        <span class="badge bg-secondary">N/A</span>
    @endif
</td>
HTML;
            }

            if ($field['type'] === 'input' && $field['inputType'] === 'file') {
                return <<<HTML
<td class="v-center">
    <img src="{{ asset(\$item->$name) }}" width="60" height="60" class="rounded-circle" alt="no image">
</td>
HTML;
            }

            if ($field['type'] === 'textarea' || $name === 'description') {
                return <<<HTML
<td class="v-center" style="vertical-align: middle;">
    <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
        {{ strip_tags(\$item->$name) }}
    </div>
</td>
HTML;
            }

            return <<<HTML
<td class="v-center">{{ \$item->$name ?? 'N/A' }}</td>
HTML;
        })->implode("\n");

        return <<<BLADE
@extends('admin.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst('$viewName'))

@section('content')

@if (\$errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach (\$errors->all() as \$error)
                <li>{{ \$error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-2 d-flex justify-content-end fw-bold">
    <button id="toggleButton" class="btn btn-sm btn-success px-4 fs-5">Create {{ ucfirst('$viewName') }}</button>
</div>

<div id="create-form-section">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Add {{ ucfirst('$viewName') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin-$viewName.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    $fieldsHtml

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All {{ ucfirst('$viewName') }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>SN.</th>
                                $tableHeaders
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\$items as \$item)
                                <tr>
                                    <td class="v-center">{{ \$loop->iteration }}</td>
                                    $tableCells
                                    <td class="v-center">
                                        <a href="{{ route('admin-$viewName.edit', \$item->id) }}" class="btn btn-sm btn-success px-4 m-1">Edit</a>
                                        <form action="{{ route('admin-$viewName.destroy', \$item->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm px-4 m-1" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%" class="text-center text-muted">No Data available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

BLADE;
    }

    private function renderField(array $field): string
    {
        $name = $field['name'];
        $isRequired = $field['required'];
        $label = $this->label($name) . ($isRequired ? ' <span class="astrick">*</span>' : '');
        $inputClass = "@error('$name') is-invalid @enderror";
        $errorBlock = "@error('$name')<div class=\"invalid-feedback\">{{ \$message }}</div>@enderror";

        if ($field['type'] === 'input' && $field['inputType'] === 'file') {
            $this->fileInputCounter++;
            return <<<HTML
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="$name" class="form-label">$label</label>
            <input type="file" class="form-control preview-image-input $inputClass" name="$name" id="$name" accept="image/*">
            $errorBlock
        </div>
    </div>
    <div class="col-md-6 d-flex align-items-center justify-content-center">
        <img id="photo_preview_$name" src="" alt="Selected Image" style="max-width: 5rem; display: none; border: 1px solid #ccc; padding: 5px;">
    </div>
</div>
HTML;
        }

        if ($field['type'] === 'input') {
            return <<<HTML
<div class="mb-3">
    <label for="$name" class="form-label">$label</label>
    <input type="{$field['inputType']}" name="$name" id="$name" class="form-control $inputClass" value="{{ old('$name') }}">
    $errorBlock
</div>
HTML;
        }

        if ($field['type'] === 'textarea') {
            $this->textareaCounter++;
            $textareaId = "description{$this->textareaCounter}";
            return <<<HTML
<div class="mb-3">
    <label for="$textareaId" class="form-label">$label</label>
    <textarea name="$name" id="$textareaId" class="form-control $inputClass" rows="4">{{ old('$name') }}</textarea>
    $errorBlock
</div>
HTML;
        }

        if ($field['type'] === 'select') {
            return <<<HTML
<div class="mb-3">
    <label for="$name" class="form-label">$label</label>
    <select name="$name" id="$name" class="form-select $inputClass">
        <option value="1" {{ old('$name') == '1' ? 'selected' : '' }}>Active</option>
        <option value="0" {{ old('$name') == '0' ? 'selected' : '' }}>Inactive</option>
    </select>
    $errorBlock
</div>
HTML;
        }

        return "<!-- Unknown field type: {$field['type']} -->";
    }

    private function label($name): string
    {
        return Str::headline($name);
    }
}
