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

                <form action="{{ route('admin-blog.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="blog_image" class="form-label">Blog Image </label>
            <input type="file" class="form-control preview-image-input @error('blog_image') is-invalid @enderror" name="blog_image" id="blog_image" data-preview-id="photo_preview_blog_image" accept="image/*">
            @error('blog_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-6 d-flex align-items-center justify-content-center">
        <img id="photo_preview_blog_image" src="{{ asset($item->blog_image) }}" alt="No Image" style="max-width: 5rem; border: 1px solid #ccc; padding: 5px;">
        <input type="hidden" name="status_blog_image" id="status_blog_image" value="{{ $item->blog_image ? 1 : 0 }}">
        <button type="button" id="statusPhotoBtn_blog_image" class="btn btn-danger btn-sm m-2">
            <i class="fas fa-trash"></i> Delete Image
        </button>
    </div>
</div>

<div class="mb-3">
    <label for="blog_title" class="form-label">Blog Title <span class="text-danger">*</span></label>
    <input type="text" name="blog_title" id="blog_title" class="form-control @error('blog_title') is-invalid @enderror" value="{{ old('blog_title', $item->blog_title ?? '') }}">
    @error('blog_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="blog_description" class="form-label">Blog Description </label>
    <textarea name="blog_description" id="blog_description" class="form-control @error('blog_description') is-invalid @enderror" rows="4">{{ old('blog_description', $item->blog_description ?? '') }}</textarea>
    @error('blog_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
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