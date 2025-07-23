@extends('admin.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst("Com Reg License Sec"))

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
    <button id="toggleButton" class="btn btn-sm btn-success px-4 fs-5">Create {{ ucfirst("Com Reg License Sec") }}</button>
</div>

<div id="create-form-section">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Add {{ ucfirst("Com Reg License Sec") }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin-com-reg-license-sec.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
  <div class="col-md-6 mb-3">
    <label for="license_image" class="form-label">License Image </label>
    <input type="file" name="license_image" id="license_image" class="form-control preview-image-input @error('license_image') is-invalid @enderror" data-preview-id="photo_preview_1" accept="image/*">
    @error('license_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="col-md-6 d-flex justify-content-center align-items-center">
    <img id="photo_preview_1" src="" style="max-width:5rem;border:1px solid#ccc;padding:5px; display:none;">
  </div>
</div>

<div class="mb-3">
    <label for="license_name" class="form-label">License Name <span class="astrick">*</span></label>
    <input type="text" name="license_name" id="license_name" class="form-control @error('license_name') is-invalid @enderror" value="{{ old('license_name') }}">
    @error('license_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="description1" class="form-label">License Description</label>
    <textarea name="license_description" id="description1" class="form-control @error('license_description') is-invalid @enderror" rows="4">{{ old('license_description') }}</textarea>
    @error('license_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                <h4 class="card-title">All {{ ucfirst("Com Reg License Sec") }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>SN.</th>
                                <th>License Image</th>
<th>License Name</th>
<th>License Description</th>
<th>Is Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                                <tr>
                                    <td class="v-center">{{ $loop->iteration }}</td>
                                    <td class="v-center">
    <img src="{{ asset($item->license_image) }}" width="60" height="60" class="rounded-circle" alt="no image">
</td>
<td class="v-center">{{ $item->license_name ?? 'N/A' }}</td>
<td class="v-center" style="vertical-align: middle;">
    <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
        {{ strip_tags($item->license_description) }}
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
                                        <a href="{{ route('admin-com-reg-license-sec.edit', $item->id) }}" class="btn btn-sm btn-success px-4 m-1">Edit</a>
                                        <form action="{{ route('admin-com-reg-license-sec.destroy', $item->id) }}" method="POST" style="display:inline-block;">
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