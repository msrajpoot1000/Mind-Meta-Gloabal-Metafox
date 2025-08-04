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

                <form action="{{ route('admin-home-slider.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="banner_image" class="form-label">Banner Image </label>
            <input type="file" class="form-control preview-image-input @error('banner_image') is-invalid @enderror" name="banner_image" id="banner_image" data-preview-id="photo_preview_banner_image" accept="image/*">
            @error('banner_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-6 d-flex align-items-center justify-content-center">
        <img id="photo_preview_banner_image" src="{{ asset($item->banner_image) }}" alt="No Image" style="max-width: 5rem; border: 1px solid #ccc; padding: 5px;">
        <input type="hidden" name="status_banner_image" id="status_banner_image" value="{{ $item->banner_image ? 1 : 0 }}">
        <button type="button" id="statusPhotoBtn_banner_image" class="btn btn-danger btn-sm m-2">
            <i class="fas fa-trash"></i> Delete Image
        </button>
    </div>
</div>

<div class="mb-3">
    <label for="banner_heading" class="form-label">Banner Heading <span class="text-danger">*</span></label>
    <textarea name="banner_heading" id="description1" class="form-control @error('banner_heading') is-invalid @enderror" rows="4">{{ old('banner_heading', $item->banner_heading ?? '') }}</textarea>
    @error('banner_heading')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="banner_sub_heading" class="form-label">Banner Sub Heading </label>
    <textarea name="banner_sub_heading" id="description2" class="form-control @error('banner_sub_heading') is-invalid @enderror" rows="4">{{ old('banner_sub_heading', $item->banner_sub_heading ?? '') }}</textarea>
    @error('banner_sub_heading')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="banner_description" class="form-label">Banner Description </label>
    <textarea name="banner_description" id="description3" class="form-control @error('banner_description') is-invalid @enderror" rows="4">{{ old('banner_description', $item->banner_description ?? '') }}</textarea>
    @error('banner_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
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