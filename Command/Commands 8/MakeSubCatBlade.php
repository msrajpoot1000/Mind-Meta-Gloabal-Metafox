<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeSubCatBlade extends Command
{
    protected $signature = 'make:sub-cat-blade {viewName} {--fields=*}';
    protected $description = 'Generate a Blade view with dynamic input fields and table';

    private int $fileInputCounter = 0;
    private int $textareaCounter = 0;
    private string $belongsToLabel = '';
    private string $belongsToRelation = '';

    public function handle()
    {
        $viewName = $this->argument('viewName');
        $fields = $this->option('fields');

        $parsedFields = [];

        foreach ($fields as $field) {
            $parts = explode(':', $field);

            if ($parts[0] === 'ref_id' && $parts[1] === 'belongsTo' && isset($parts[2])) {
                $model = $parts[2];
                $this->belongsToLabel = Str::headline($model);
                $this->belongsToRelation = Str::camel(Str::singular($model));
                continue;
            }

            $parsedFields[] = [
                'type'      => $parts[0],
                'inputType' => $parts[0] === 'input' ? $parts[1] : null,
                'name'      => $parts[0] === 'input' ? $parts[2] : $parts[1],
                'required'  => in_array('required', $parts),
            ];
        }

        $viewPath = resource_path("views/admin/pages/{$viewName}.blade.php");
        if (File::exists($viewPath)) {
            $this->error("View already exists: {$viewPath}");
            return;
        }

        $content = $this->generateBladeView($viewName, $parsedFields);
        File::ensureDirectoryExists(dirname($viewPath));
        File::put($viewPath, $content);
        $this->info("Created: {$viewPath}");
    }

    private function generateBladeView($viewName, $fields): string
    {
        $labelText = $this->belongsToLabel ?: $this->getCategoryLabel($viewName);
        $dynamicHtml = collect($fields)->map(fn($f) => $this->renderField($f))->implode("\n\n");

        $refField = <<<HTML
<div class="row">
  <div class="col-md-6">
    <div class="mb-3">
      <label>{$labelText} <span class="text-danger">*</span></label>
      <select name="ref_id" class="form-control">
        <option value="">-- Select --</option>
        @foreach(\$items1 as \$item)
          <option value="{{ \$item->id }}">{{ \$item->name }}</option>
        @endforeach
      </select>
    </div>
  </div>
</div>
HTML;

        $tableHeaders = "<th>{$labelText}</th>\n" .
            collect($fields)->map(fn($f) => "<th>" . Str::headline($f['name']) . "</th>")->implode("\n");
        $relationCell = "<td class=\"v-center\">{{ \$item->{$this->belongsToRelation}->name ?? 'N/A' }}</td>\n";
        $tableCells = $relationCell . collect($fields)->map(fn($f) => $this->renderCell($f))->implode("\n");

        return <<<BLADE
@extends('admin.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst('$viewName'))

@section('content')
@if (\$errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach(\$errors->all() as \$error)
        <li>{{ \$error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="mb-2 text-end">
  <button id="toggleButton" class="btn btn-sm btn-success">Create {{ ucfirst('$viewName') }}</button>
</div>

<div id="create-form-section">
  <div class="card">
    <div class="card-header"><h4>Add {{ ucfirst('$viewName') }}</h4></div>
    <div class="card-body">
      <form action="{{ route('admin-$viewName.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {$refField}

        {$dynamicHtml}

        <div class="mt-4">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="mt-4 card">
  <div class="card-header"><h4>All {{ ucfirst('$viewName') }}</h4></div>
  <div class="card-body table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>SN.</th>
          {$tableHeaders}
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse(\$items2 as \$item)
          <tr>
            <td>{{ \$loop->iteration }}</td>
            {$tableCells}
            <td>
              <a href="{{ route('admin-$viewName.edit', \$item->id) }}" class="btn btn-sm btn-success">Edit</a>
              <form action="{{ route('admin-$viewName.destroy', \$item->id) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="100%" class="text-center text-muted">No Data available.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
BLADE;
    }

    private function renderField(array $f): string
    {
        $name        = $f['name'];
        $label       = Str::headline($name);
        $inputClass  = "@error('$name') is-invalid @enderror";
        $errorBlock  = "@error('$name')<div class=\"invalid-feedback\">{{ \$message }}</div>@enderror";
        $requiredSpan = $f['required'] ? '<span class="text-danger">*</span>' : '';

        if ($f['type'] === 'input' && $f['inputType'] === 'file') {
            $this->fileInputCounter++;
            $previewId = "photo_preview_{$this->fileInputCounter}";
            return <<<HTML
<div class="row">
  <div class="col-md-6 mb-3">
    <label for="$name" class="form-label">$label $requiredSpan</label>
    <input type="file" name="$name" id="$name" class="form-control preview-image-input $inputClass" data-preview-id="$previewId" accept="image/*">
    $errorBlock
  </div>
  <div class="col-md-6 d-flex justify-content-center align-items-center">
    <img id="$previewId" src="" style="max-width:5rem;border:1px solid#ccc;padding:5px; display:none;">
  </div>
</div>
HTML;
        }

        if ($f['type'] === 'input') {
            return <<<HTML
<div class="mb-3">
  <label for="$name" class="form-label">$label $requiredSpan</label>
  <input type="{$f['inputType']}" name="$name" id="$name" class="form-control $inputClass" value="{{ old('$name') }}">
  $errorBlock
</div>
HTML;
        }

        if ($f['type'] === 'textarea') {
            $this->textareaCounter++;
            return <<<HTML
<div class="mb-3">
  <label for="$name" class="form-label">$label $requiredSpan</label>
  <textarea name="$name" id="$name" class="form-control $inputClass" rows="4">{{ old('$name') }}</textarea>
  $errorBlock
</div>
HTML;
        }

        if ($f['type'] === 'select') {
            return <<<HTML
<div class="mb-3">
  <label for="$name" class="form-label">$label $requiredSpan</label>
  <select name="$name" id="$name" class="form-select $inputClass">
    <option value="1" {{ old('$name') == '1' ? 'selected' : '' }}>Active</option>
    <option value="0" {{ old('$name') == '0' ? 'selected' : '' }}>Inactive</option>
  </select>
  $errorBlock
</div>
HTML;
        }

        return "<!-- Unknown field: {$name} -->";
    }

    private function renderCell(array $f): string
    {
        $name = $f['name'];
        if ($name === 'is_active') {
            return <<<HTML
<td class="v-center">
  @if(\$item->$name==1)
    <span class="badge bg-success">Active</span>
  @elseif(\$item->$name==0)
    <span class="badge bg-danger">Inactive</span>
  @else
    <span class="badge bg-secondary">N/A</span>
  @endif
</td>
HTML;
        }

        if ($f['type'] === 'input' && $f['inputType'] === 'file') {
            return <<<HTML
<td class="v-center">
  <img src="{{ asset(\$item->$name) }}" width="60" height="60" class="rounded-circle" alt="">
</td>
HTML;
        }

        if ($f['type'] === 'textarea') {
            return <<<HTML
<td class="v-center text-truncate" style="max-width:200px;">{{ strip_tags(\$item->$name) }}</td>
HTML;
        }

        return "<td class=\"v-center\">{{ \$item->$name ?? 'N/A' }}</td>";
    }

    private function getCategoryLabel(string $view): string
    {
        $chunk = last(explode('-', $view));
        return Str::headline($chunk);
    }
}
