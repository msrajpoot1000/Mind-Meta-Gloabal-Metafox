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

                <form action="{{ route('admin-tree1s.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="img1" class="form-label">Img1 <span class="text-danger">*</span></label>
            <input type="file" class="form-control preview-image-input @error('img1') is-invalid @enderror" name="img1" id="img1" data-preview-id="photo_preview_img1" accept="image/*">
            @error('img1')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-6 d-flex align-items-center justify-content-center">
        <img id="photo_preview_img1" src="{{ asset($item->img1) }}" alt="No Image" style="max-width: 5rem; border: 1px solid #ccc; padding: 5px;">
<input type="hidden" name="status_img1" id="status_img1" value="{{ $item->img1 ? 1 : 0 }}">
        <button type="button" id="statusPhotoBtn_img1" class="btn btn-danger btn-sm m-2">
            <i class="fas fa-trash"></i> Delete Image
        </button>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="img2" class="form-label">Img2 </label>
            <input type="file" class="form-control preview-image-input @error('img2') is-invalid @enderror" name="img2" id="img2" data-preview-id="photo_preview_img2" accept="image/*">
            @error('img2')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-6 d-flex align-items-center justify-content-center">
        <img id="photo_preview_img2" src="{{ asset($item->img2) }}" alt="No Image" style="max-width: 5rem; border: 1px solid #ccc; padding: 5px;">
<input type="hidden" name="status_img2" id="status_img2" value="{{ $item->img2 ? 1 : 0 }}">
        <button type="button" id="statusPhotoBtn_img2" class="btn btn-danger btn-sm m-2">
            <i class="fas fa-trash"></i> Delete Image
        </button>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="img3" class="form-label">Img3 <span class="text-danger">*</span></label>
            <input type="file" class="form-control preview-image-input @error('img3') is-invalid @enderror" name="img3" id="img3" data-preview-id="photo_preview_img3" accept="image/*">
            @error('img3')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="col-md-6 d-flex align-items-center justify-content-center">
        <img id="photo_preview_img3" src="{{ asset($item->img3) }}" alt="No Image" style="max-width: 5rem; border: 1px solid #ccc; padding: 5px;">
<input type="hidden" name="status_img3" id="status_img3" value="{{ $item->img3 ? 1 : 0 }}">
        <button type="button" id="statusPhotoBtn_img3" class="btn btn-danger btn-sm m-2">
            <i class="fas fa-trash"></i> Delete Image
        </button>
    </div>
</div>

<div class="mb-3">
    <label for="description1" class="form-label">Description1 <span class="text-danger">*</span></label>
    <textarea name="description1" id="description1" class="form-control @error('description1') is-invalid @enderror" rows="4">{{ old('description1', $item->description1 ?? '') }}</textarea>
    @error('description1')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="description2" class="form-label">Description2 <span class="text-danger">*</span></label>
    <textarea name="description2" id="description2" class="form-control @error('description2') is-invalid @enderror" rows="4">{{ old('description2', $item->description2 ?? '') }}</textarea>
    @error('description2')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="description3" class="form-label">Description3 </label>
    <textarea name="description3" id="description3" class="form-control @error('description3') is-invalid @enderror" rows="4">{{ old('description3', $item->description3 ?? '') }}</textarea>
    @error('description3')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $item->name ?? '') }}">
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
