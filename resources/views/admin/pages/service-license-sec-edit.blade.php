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

                    <form action="{{ route('admin-service-license-sec.update', $item->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="license_image" class="form-label">License Image </label>
                                    <input type="file"
                                        class="form-control preview-image-input @error('license_image') is-invalid @enderror"
                                        name="license_image" id="license_image"
                                        data-preview-id="photo_preview_license_image" accept="image/*">
                                    @error('license_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 d-flex align-items-center justify-content-center">
                                <img id="photo_preview_license_image" src="{{ asset($item->license_image) }}" alt="No Image"
                                    style="max-width: 5rem; border: 1px solid #ccc; padding: 5px;">
                                <input type="hidden" name="status_license_image" id="status_license_image"
                                    value="{{ $item->license_image ? 1 : 0 }}">
                                <button type="button" id="statusPhotoBtn_license_image" class="btn btn-danger btn-sm m-2">
                                    <i class="fas fa-trash"></i> Delete Image
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="license_name" class="form-label">License Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="license_name" id="license_name"
                                class="form-control @error('license_name') is-invalid @enderror"
                                value="{{ old('license_name', $item->license_name ?? '') }}">
                            @error('license_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="license_description" class="form-label">License Description </label>
                            <textarea name="license_description" id="description1"
                                class="form-control @error('license_description') is-invalid @enderror" rows="4">{{ old('license_description', $item->license_description ?? '') }}</textarea>
                            @error('license_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="is_active" class="form-label">Is Active </label>
                            <select name="is_active" id="is_active"
                                class="form-select @error('is_active') is-invalid @enderror">
                                <option value="1" {{ old('is_active', $item->is_active) == '1' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="0" {{ old('is_active', $item->is_active) == '0' ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
