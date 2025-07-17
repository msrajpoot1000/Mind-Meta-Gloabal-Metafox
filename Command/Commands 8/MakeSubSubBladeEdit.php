<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeSubSubBladeEdit extends Command
{
    protected $signature = 'make:sub-sub-cat-edit-blade {viewName} {--fields=*}';
    protected $description = 'Generate an edit Blade view with dynamic form fields';

    private int $fileCounter = 0;
    private int $textareaCounter = 0;

    public function handle()
    {
        $viewName = $this->argument('viewName');
        $fields = $this->option('fields');

        $modelSlug = Str::before($viewName, '-edit');
        $topSlug = $this->extractTopSlug($viewName);
        $routeName = 'admin-' . $modelSlug . '.update';
        $viewPath = resource_path("views/admin/pages/{$viewName}.blade.php");

        if (File::exists($viewPath)) {
            $this->error("Blade view already exists: $viewPath");
            return;
        }

        $refModel = null;
        $parsedFields = [];
        $belongsToModels = [];

        foreach ($fields as $field) {
            $parts = explode(':', $field);
            $base = $parts[0];

            if ($base === 'input' && count($parts) >= 4) {
                $parsedFields[] = [
                    'type' => 'input',
                    'inputType' => $parts[1],
                    'name' => $parts[2],
                    'validation' => $parts[3] ?? '',
                ];
            } elseif ($base === 'textarea' && count($parts) >= 3) {
                $parsedFields[] = [
                    'type' => 'textarea',
                    'inputType' => null,
                    'name' => $parts[1],
                    'validation' => $parts[2] ?? '',
                ];
            } elseif ($base === 'select' && count($parts) >= 3) {
                $parsedFields[] = [
                    'type' => 'select',
                    'inputType' => null,
                    'name' => $parts[1],
                    'validation' => $parts[2] ?? '',
                ];
            } elseif ($base === 'ref_id' && $parts[1] === 'belongsTo' && count($parts) >= 4) {
                $parsedFields[] = [
                    'type' => 'belongsTo',
                    'inputType' => $parts[2],
                    'name' => 'ref_id',
                    'validation' => $parts[3] ?? '',
                ];
                $refModel = $parts[2];
                $belongsToModels[] = $parts[2];
            } else {
                $this->error("Invalid format for field: \"$field\"");
                return;
            }
        }

        $firstLevelModel = $belongsToModels[0] ?? 'Program';
        $secondLevelModel = $belongsToModels[1] ?? 'SubProgram';

        $refSlug = $refModel ? Str::kebab(Str::pluralStudly(class_basename($refModel))) : 'sub-items';

        $formFields = $this->getProgramSubProgramFields($refSlug, $topSlug, $firstLevelModel, $secondLevelModel) . "\n\n" .
            collect($parsedFields)->map(fn($field) => $this->renderField($field))->implode("\n\n");

        $content = <<<BLADE
@extends('admin.layouts.app')

@section('title', 'Dashboard | Edit Item')

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const programSelect = document.getElementById('programSelect');
        const subProgramSelect = document.getElementById('subProgramSelect');
        const selectedSubProgramId = "{{ \$item2Id ?? '' }}";

        function loadSubPrograms(programId, preselectedId = null) {
            if (!programId) {
                subProgramSelect.innerHTML = '<option value="">-- Select Sub Program --</option>';
                return;
            }

            subProgramSelect.innerHTML = '<option value="">-- Loading... --</option>';

            fetch(`/get-{$refSlug}/\${programId}`)
                .then(response => response.json())
                .then(data => {
                    subProgramSelect.innerHTML = '<option value="">-- Select Sub Program --</option>';
                    data.forEach(sub => {
                        const option = document.createElement('option');
                        option.value = sub.id;
                        option.textContent = sub.name;
                        if (preselectedId && sub.id == preselectedId) {
                            option.selected = true;
                        }
                        subProgramSelect.appendChild(option);
                    });
                })
                .catch(() => {
                    subProgramSelect.innerHTML = '<option value="">-- Error Loading --</option>';
                });
        }

        programSelect.addEventListener('change', function () {
            loadSubPrograms(this.value);
        });

        if (programSelect.value) {
            loadSubPrograms(programSelect.value, selectedSubProgramId);
        }
    });
</script>
@endsection

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Edit Item</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('$routeName', \$item3->id) }}" method="POST" enctype="multipart/form-data">
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

        $this->info("✅ Edit Blade view created: $viewPath");
    }

    private function extractTopSlug(string $viewName): string
    {
        $parts = explode('-', $viewName);
        return $parts[2] ?? 'programs';
    }

    private function renderField(array $field): string
    {
        $name = $field['name'];
        $label = Str::headline($name);
        $isRequired = str_contains($field['validation'] ?? '', 'required');
        $requiredSpan = $isRequired ? ' <span class="astrick">*</span>' : '';
        $inputClass = "@error('$name') is-invalid @enderror";
        $errorBlock = "@error('$name')<div class=\"invalid-feedback\">{{ \$message }}</div>@enderror";

        if ($field['type'] === 'input' && $field['inputType'] === 'file') {
            $this->fileCounter++;
            return <<<HTML
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="$name" class="form-label">$label$requiredSpan</label>
            <input type="file" class="form-control preview-image-input $inputClass" name="$name" id="$name" data-preview-id="photo_preview_$name" accept="image/*">
            $errorBlock
        </div>
    </div>
    <div class="col-md-6 d-flex align-items-center justify-content-center">
        <img id="photo_preview_$name" src="{{ asset(\$item3->$name) }}" alt="Selected Image" style="max-width: 5rem; border: 1px solid #ccc; padding: 5px;">
        <input type="hidden" name="status_{$name}" id="status_{$name}" value="1">
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
    <label for="$name" class="form-label">$label$requiredSpan</label>
    <input type="{$field['inputType']}" name="$name" id="$name" class="form-control $inputClass" value="{{ old('$name', \$item3->$name ?? '') }}">
    $errorBlock
</div>
HTML;
        }

        if ($field['type'] === 'textarea') {
            $this->textareaCounter++;
            $textareaId = "description{$this->textareaCounter}";

            return <<<HTML
<div class="mb-3">
    <label for="$textareaId" class="form-label">$label$requiredSpan</label>
    <textarea name="$name" id="$textareaId" class="form-control $inputClass" rows="4">{{ old('$name', \$item3->$name ?? '') }}</textarea>
    $errorBlock
</div>
HTML;
        }

        if ($field['type'] === 'select') {
            return <<<HTML
<div class="mb-3">
    <label for="$name" class="form-label">$label$requiredSpan</label>
    <select name="$name" id="$name" class="form-select $inputClass">
        <option value="1" {{ old('$name', \$item3->$name) == '1' ? 'selected' : '' }}>Active</option>
        <option value="0" {{ old('$name', \$item3->$name) == '0' ? 'selected' : '' }}>Inactive</option>
    </select>
    $errorBlock
</div>
HTML;
        }

        return "<!-- Unknown field type: {$field['type']} -->";
    }

    private function getProgramSubProgramFields(string $refSlug, string $topSlug, string $firstLevelModel, string $secondLevelModel): string
    {
        $programLabel = Str::headline($firstLevelModel);
        $subProgramLabel = Str::headline($secondLevelModel);
        return <<<HTML
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="programSelect">$programLabel <span class="astrick">*</span></label>
            <select name="head_ref_id" class="form-control" id="programSelect">
                <option value="">-- Select $programLabel --</option>
                @foreach (\$items1 as \$item)
                    <option value="{{ \$item->id }}" {{ \$item->id == \$item1Id ? 'selected' : '' }}>{{ \$item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="subProgramSelect">$subProgramLabel <span class="astrick">*</span></label>
            <select name="ref_id" class="form-control" id="subProgramSelect">
                <option value="">-- Select $subProgramLabel --</option>
            </select>
        </div>
    </div>
</div>
HTML;
    }
}
