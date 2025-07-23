@extends('admin.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst("Blog"))

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-2 d-flex justify-content-end fw-bold">
    <button id="toggleButton" class="btn btn-sm btn-success px-4 fs-5">Create {{ ucfirst("Blog") }}</button>
</div>

<div id="create-form-section">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Add {{ ucfirst("Blog") }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin-blog.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
  <div class="col-md-6 mb-3">
    <label for="blog_image" class="form-label">Blog Image </label>
    <input type="file" name="blog_image" id="blog_image" class="form-control preview-image-input @error('blog_image') is-invalid @enderror" data-preview-id="photo_preview_1" accept="image/*">
    @error('blog_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="col-md-6 d-flex justify-content-center align-items-center">
    <img id="photo_preview_1" src="" style="max-width:5rem;border:1px solid#ccc;padding:5px; display:none;">
  </div>
</div>

<div class="mb-3">
    <label for="blog_title" class="form-label">Blog Title <span class="astrick">*</span></label>
    <input type="text" name="blog_title" id="blog_title" class="form-control @error('blog_title') is-invalid @enderror" value="{{ old('blog_title') }}">
    @error('blog_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="description1" class="form-label">Blog Description</label>
    <textarea name="blog_description" id="description1" class="form-control @error('blog_description') is-invalid @enderror" rows="4">{{ old('blog_description') }}</textarea>
    @error('blog_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="is_active" class="form-label">Is Active</label>
    <select name="is_active" id="is_active" class="form-select @error('is_active') is-invalid @enderror">
        <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
    </select>
    @error('is_active')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

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
                <h4 class="card-title">All {{ ucfirst("Blog") }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>SN.</th>
                                <th>Blog Image</th>
<th>Blog Title</th>
<th>Blog Description</th>
<th>Is Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                                <tr>
                                    <td class="v-center">{{ $loop->iteration }}</td>
                                    <td class="v-center">
    <img src="{{ asset($item->blog_image) }}" width="60" height="60" class="rounded-circle" alt="no image">
</td>
<td class="v-center">{{ $item->blog_title ?? 'N/A' }}</td>
<td class="v-center" style="vertical-align: middle;">
    <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
        {{ strip_tags($item->blog_description) }}
    </div>
</td>
<td class="v-center">
    @if ($item->is_active == 1)
        <span class="badge bg-success">Active</span>
    @elseif ($item->is_active == 0)
        <span class="badge bg-danger">Inactive</span>
    @else
        <span class="badge bg-secondary">N/A</span>
    @endif
</td>
                                    <td class="v-center">
                                        <a href="{{ route('admin-blog.edit', $item->id) }}" class="btn btn-sm btn-success px-4 m-1">Edit</a>
                                        <form action="{{ route('admin-blog.destroy', $item->id) }}" method="POST" style="display:inline-block;">
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