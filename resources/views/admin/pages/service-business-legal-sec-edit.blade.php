@extends('admin.layouts.app')

@section('title', 'Dashboard | Edit Item')

@section('content')
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Edit Item</h4>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body">

                <form action="{{ route('admin-service-business-legal-sec.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $item->name ?? '') }}">
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description </label>
    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $item->description ?? '') }}</textarea>
    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="is_active" class="form-label">Is Active </label>
    <select name="is_active" id="is_active" class="form-select @error('is_active') is-invalid @enderror">
        <option value="1" {{ old('is_active', $item->is_active) == '1' ? 'selected' : '' }}>Active</option>
        <option value="0" {{ old('is_active', $item->is_active) == '0' ? 'selected' : '' }}>Inactive</option>
    </select>
    @error('is_active')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary w-md">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection