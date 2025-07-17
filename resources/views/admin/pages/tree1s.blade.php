@extends('admin.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst('tree1s'))

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
    <button id="toggleButton" class="btn btn-sm btn-success px-4 fs-5">Create {{ ucfirst('tree1s') }}</button>
</div>

<div id="create-form-section">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Add {{ ucfirst('tree1s') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin-tree1s.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
  <div class="col-md-6 mb-3">
    <label for="img1" class="form-label">Img1 <span class="astrick">*</span> </label>
    <input type="file" name="img1" id="img1" class="form-control preview-image-input @error('img1') is-invalid @enderror" data-preview-id="photo_preview_1" accept="image/*">
    @error('img1')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="col-md-6 d-flex justify-content-center align-items-center">
    <img id="photo_preview_1" src="" style="max-width:5rem;border:1px solid#ccc;padding:5px; display:none;">
  </div>
</div>

<div class="row">
  <div class="col-md-6 mb-3">
    <label for="img2" class="form-label">Img2 </label>
    <input type="file" name="img2" id="img2" class="form-control preview-image-input @error('img2') is-invalid @enderror" data-preview-id="photo_preview_2" accept="image/*">
    @error('img2')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="col-md-6 d-flex justify-content-center align-items-center">
    <img id="photo_preview_2" src="" style="max-width:5rem;border:1px solid#ccc;padding:5px; display:none;">
  </div>
</div>

<div class="row">
  <div class="col-md-6 mb-3">
    <label for="img3" class="form-label">Img3 <span class="astrick">*</span> </label>
    <input type="file" name="img3" id="img3" class="form-control preview-image-input @error('img3') is-invalid @enderror" data-preview-id="photo_preview_3" accept="image/*">
    @error('img3')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="col-md-6 d-flex justify-content-center align-items-center">
    <img id="photo_preview_3" src="" style="max-width:5rem;border:1px solid#ccc;padding:5px; display:none;">
  </div>
</div>

<div class="mb-3">
    <label for="description1" class="form-label">Description1 <span class="astrick">*</span></label>
    <textarea name="description1" id="description1" class="form-control @error('description1') is-invalid @enderror" rows="4">{{ old('description1') }}</textarea>
    @error('description1')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="description2" class="form-label">Description2 <span class="astrick">*</span></label>
    <textarea name="description2" id="description2" class="form-control @error('description2') is-invalid @enderror" rows="4">{{ old('description2') }}</textarea>
    @error('description2')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="description3" class="form-label">Description3</label>
    <textarea name="description3" id="description3" class="form-control @error('description3') is-invalid @enderror" rows="4">{{ old('description3') }}</textarea>
    @error('description3')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="name" class="form-label">Name <span class="astrick">*</span></label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                <h4 class="card-title">All {{ ucfirst('tree1s') }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>SN.</th>
                                <th>Img1</th>
<th>Img2</th>
<th>Img3</th>
<th>Description1</th>
<th>Description2</th>
<th>Description3</th>
<th>Name</th>
<th>Is Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                                <tr>
                                    <td class="v-center">{{ $loop->iteration }}</td>
                                    <td class="v-center">
    <img src="{{ asset($item->img1) }}" width="60" height="60" class="rounded-circle" alt="no image">
</td>
<td class="v-center">
    <img src="{{ asset($item->img2) }}" width="60" height="60" class="rounded-circle" alt="no image">
</td>
<td class="v-center">
    <img src="{{ asset($item->img3) }}" width="60" height="60" class="rounded-circle" alt="no image">
</td>
<td class="v-center" style="vertical-align: middle;">
    <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
        {{ strip_tags($item->description1) }}
    </div>
</td>
<td class="v-center" style="vertical-align: middle;">
    <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
        {{ strip_tags($item->description2) }}
    </div>
</td>
<td class="v-center" style="vertical-align: middle;">
    <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
        {{ strip_tags($item->description3) }}
    </div>
</td>
<td class="v-center">{{ $item->name ?? 'N/A' }}</td>
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
                                        <a href="{{ route('admin-tree1s.edit', $item->id) }}" class="btn btn-sm btn-success px-4 m-1">Edit</a>
                                        <form action="{{ route('admin-tree1s.destroy', $item->id) }}" method="POST" style="display:inline-block;">
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
