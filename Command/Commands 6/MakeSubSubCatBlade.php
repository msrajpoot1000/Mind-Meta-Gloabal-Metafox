<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeSubSubCatBlade extends Command
{
    protected $signature = 'make:sub-sub-cat-blade {viewName} {--fields=*}';
    protected $description = 'Generate a Blade view with dynamic input fields, sub-program dropdown, and table';

    private int $fileInputCounter = 0;
    private int $textareaCounter = 0;

    public function handle()
    {
        $viewName = $this->argument('viewName');
        $fields = $this->option('fields');

        $parsedFields = [];
        $belongsToModels = [];

        foreach ($fields as $field) {
            $parts = explode(':', $field);

            if ($parts[0] === 'input' && count($parts) === 3) {
                $parsedFields[] = ['type' => 'input', 'inputType' => $parts[1], 'name' => $parts[2]];
            } elseif ($parts[0] === 'textarea' && count($parts) === 2) {
                $parsedFields[] = ['type' => 'textarea', 'inputType' => null, 'name' => $parts[1]];
            } elseif ($parts[0] === 'select' && count($parts) === 2) {
                $parsedFields[] = ['type' => 'select', 'inputType' => null, 'name' => $parts[1]];
            } elseif ($parts[0] === 'ref_id' && $parts[1] === 'belongsTo' && count($parts) === 3) {
                $parsedFields[] = ['type' => 'belongsTo', 'inputType' => $parts[2], 'name' => 'ref_id'];
                $belongsToModels[] = $parts[2];
            } else {
                $this->error("Invalid field format: $field");
                return;
            }
        }

        $firstLevelModel = $belongsToModels[0] ?? null;
        $secondLevelModel = $belongsToModels[1] ?? null;

        $topSlug = $this->extractTopSlug($viewName);
        $subSlug = $secondLevelModel ? Str::kebab(Str::pluralStudly(class_basename($secondLevelModel))) : 'sub-items';
        $viewPath = resource_path("views/admin/pages/{$viewName}.blade.php");

        if (File::exists($viewPath)) {
            $this->error("Blade view already exists: $viewPath");
            return;
        }

        File::ensureDirectoryExists(dirname($viewPath));
        File::put($viewPath, $this->generateBladeView($viewName, $parsedFields, $firstLevelModel, $secondLevelModel, $subSlug));

        $this->info("✅ Blade view created at: $viewPath");
    }

    private function extractTopSlug(string $viewName): string
    {
        $parts = explode('-', $viewName);
        return end($parts) ?? 'programs';
    }

    private function generateBladeView(string $viewName, array $fields, $firstLevelModel, $secondLevelModel, $subSlug): string
    {
        $programLabel = Str::headline($firstLevelModel);
        $subProgramLabel = Str::headline($secondLevelModel);

        $dynamicFieldsHtml = collect($fields)->filter(fn($f) => $f['type'] !== 'belongsTo')->map(fn($f) => $this->renderField($f))->implode("\n\n");
        $fieldHeaders = collect($fields)->filter(fn($f) => $f['type'] !== 'belongsTo')->map(fn($f) => '<th>' . $this->label($f['name']) . '</th>')->implode("\n");
        $fieldCells = collect($fields)->filter(fn($f) => $f['type'] !== 'belongsTo')->map(fn($f) => $this->renderTableCell($f))->implode("\n");

$relationshipFields = <<<BLADE
<td class="v-center">{{ \$item->{Str::camel('$secondLevelModel')}->{Str::camel('$firstLevelModel')}->name ?? 'N/A' }}</td>
<td class="v-center">{{ \$item->{Str::camel('$secondLevelModel')}->name ?? 'N/A' }}</td>
BLADE;


        return <<<BLADE
@extends('admin.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst('$viewName'))

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('programSelect').addEventListener('change', function () {
            const programId = this.value;
            const subProgramSelect = document.getElementById('subProgramSelect');
            subProgramSelect.innerHTML = '<option value="">-- Loading... --</option>';

            if (programId) {
                fetch(`/get-{$subSlug}/\${programId}`)
                    .then(response => response.json())
                    .then(data => {
                        subProgramSelect.innerHTML = '<option value="">-- Select Sub Program     --</option>';
                        data.forEach(sub => {
                            const option = document.createElement('option');
                            option.value = sub.id;
                            option.textContent = sub.name;
                            subProgramSelect.appendChild(option);
                        });
                    })
                    .catch(() => {
                        subProgramSelect.innerHTML = '<option value="">-- Error Loading --</option>';
                    });
            } else {
                subProgramSelect.innerHTML = '<option value="">-- Select Sub Program --</option>';
            }
        });
    });
</script>
@endsection

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

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>$programLabel</label>
                                <select name="head_ref_id" class="form-control" id="programSelect" required>
                                    <option value="">-- Select $programLabel --</option>
                                    @foreach (\$items1 as \$item)
                                        <option value="{{ \$item->id }}">{{ \$item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>$subProgramLabel</label>
                                <select name="ref_id" class="form-control" id="subProgramSelect" required>
                                    <option value="">-- Select $subProgramLabel --</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    $dynamicFieldsHtml

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
                                <th>$programLabel</th>
                                <th>$subProgramLabel</th>
                                $fieldHeaders
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse (\$items3 as \$item)
                                <tr>
                                    <td class="v-center">{{ \$loop->iteration }}</td>
                                    $relationshipFields
                                    $fieldCells
                                    <td class="v-center">
                                        <a href="{{ route('admin-$viewName.edit', \$item->id) }}" class="btn btn-sm btn-success">Edit</a>
                                        <form action="{{ route('admin-$viewName.destroy', \$item->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%" class="text-center">No Data Available</td>
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
        $label = $this->label($name);
        $class = "@error('$name') is-invalid @enderror";
        $error = "@error('$name')<div class=\"invalid-feedback\">{{ \$message }}</div>@enderror";

        if ($field['type'] === 'input' && $field['inputType'] === 'file') {
            $this->fileInputCounter++;
            $id = "photo{$this->fileInputCounter}";
            $previewId = "photo_preview{$this->fileInputCounter}";
            return <<<HTML
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="$id" class="form-label">$label</label>
            <input type="file" name="$name" id="$id" class="form-control preview-image-input $class" data-preview-id="$previewId" accept="image/*">
            $error
        </div>
    </div>
    <div class="col-md-6 d-flex align-items-center justify-content-center">
        <img id="$previewId" src="#" alt="Preview" style="max-width: 5rem; display: none; border: 1px solid #ccc;">
    </div>
</div>
HTML;
        }

        if ($field['type'] === 'input') {
            return <<<HTML
<div class="mb-3">
    <label for="$name" class="form-label">$label</label>
    <input type="{$field['inputType']}" name="$name" id="$name" value="{{ old('$name') }}" class="form-control $class">
    $error
</div>
HTML;
        }

        if ($field['type'] === 'textarea') {
            $this->textareaCounter++;
            $id = "description{$this->textareaCounter}";
            return <<<HTML
<div class="mb-3">
    <label for="$id" class="form-label">$label</label>
    <textarea name="$name" id="$id" rows="4" class="form-control $class">{{ old('$name') }}</textarea>
    $error
</div>
HTML;
        }

        if ($field['type'] === 'select') {
            return <<<HTML
<div class="mb-3">
    <label for="$name" class="form-label">$label</label>
    <select name="$name" id="$name" class="form-select $class">
        <option value="1" {{ old('$name') == '1' ? 'selected' : '' }}>Active</option>
        <option value="0" {{ old('$name') == '0' ? 'selected' : '' }}>Inactive</option>
    </select>
    $error
</div>
HTML;
        }

        return "<!-- Unknown field type -->";
    }

    private function renderTableCell(array $field): string
    {
        $name = $field['name'];

        if ($field['type'] === 'input' && $field['inputType'] === 'file') {
            return <<<HTML
<td class="v-center">
    <img src="{{ asset(\$item->$name) }}" width="60" height="60" class="rounded-circle" alt="no image">
</td>
HTML;
        }

        if ($field['type'] === 'textarea') {
            return <<<HTML
<td class="v-center" style="vertical-align: middle;">
    <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
        {{ strip_tags(\$item->$name) }}
    </div>
</td>
HTML;
        }

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

        return <<<HTML
<td class="v-center">{{ \$item->$name ?? 'N/A' }}</td>
HTML;
    }

    private function label(string $name): string
    {
        return Str::headline($name);
    }
}
