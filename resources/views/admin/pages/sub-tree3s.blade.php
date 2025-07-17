@extends('admin.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst('sub-tree3s'))

@section('content')
@if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="mb-2 text-end">
  <button id="toggleButton" class="btn btn-sm btn-success">Create {{ ucfirst('sub-tree3s') }}</button>
</div>

<div id="create-form-section">
  <div class="card">
    <div class="card-header"><h4>Add {{ ucfirst('sub-tree3s') }}</h4></div>
    <div class="card-body">
      <form action="{{ route('admin-sub-tree3s.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
  <div class="col-md-6">
    <div class="mb-3">
      <label>Tree1 <span class="text-danger">*</span></label>
      <select name="ref_id" class="form-control">
        <option value="">-- Select --</option>
        @foreach($items1 as $item)
          <option value="{{ $item->id }}">{{ $item->name }}</option>
        @endforeach
      </select>
       @error("ref_id")
       <div class="invalid-feedback">{{ $message }}</div>
       @enderror
    </div>
  </div>
</div>

        <div class="row">
  <div class="col-md-6 mb-3">
    <label for="photo" class="form-label">Photo <span class="text-danger">*</span></label>
    <input type="file" name="photo" id="photo" class="form-control preview-image-input @error('photo') is-invalid @enderror" data-preview-id="photo_preview_1" accept="image/*">
    @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="col-md-6 d-flex justify-content-center align-items-center">
    <img id="photo_preview_1" src="" style="max-width:5rem;border:1px solid#ccc;padding:5px; display:none;">
  </div>
</div>

<div class="row">
  <div class="col-md-6 mb-3">
    <label for="photo322" class="form-label">Photo322 <span class="text-danger">*</span></label>
    <input type="file" name="photo322" id="photo322" class="form-control preview-image-input @error('photo322') is-invalid @enderror" data-preview-id="photo_preview_2" accept="image/*">
    @error('photo322')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="col-md-6 d-flex justify-content-center align-items-center">
    <img id="photo_preview_2" src="" style="max-width:5rem;border:1px solid#ccc;padding:5px; display:none;">
  </div>
</div>

<div class="mb-3">
  <label for="description1" class="form-label">Description1 <span class="text-danger">*</span></label>
  <textarea name="description1" id="description1" class="form-control @error('description1') is-invalid @enderror" rows="4">{{ old('description1') }}</textarea>
  @error('description1')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
  <label for="description2" class="form-label">Description2 </label>
  <textarea name="description2" id="description2" class="form-control @error('description2') is-invalid @enderror" rows="4">{{ old('description2') }}</textarea>
  @error('description2')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
  <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
  <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
  @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
  <label for="is_active" class="form-label">Is Active </label>
  <select name="is_active" id="is_active" class="form-select @error('is_active') is-invalid @enderror">
    <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
  </select>
  @error('is_active')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

        <div class="mt-4">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="mt-4 card">
  <div class="card-header"><h4>All {{ ucfirst('sub-tree3s') }}</h4></div>
  <div class="card-body table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>SN.</th>
          <th>Tree1</th>
<th>Photo</th>
<th>Photo322</th>
<th>Description1</th>
<th>Description2</th>
<th>Name</th>
<th>Is Active</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse($items2 as $item)
          <tr>
            <td class="v-center">{{ $loop->iteration }}</td>
            <td class="v-center">{{ $item->tree1->name ?? 'N/A' }}</td>
<td class="v-center">
  <img src="{{ asset($item->photo) }}" width="60" height="60" class="rounded-circle" alt="">
</td>
<td class="v-center">
  <img src="{{ asset($item->photo322) }}" width="60" height="60" class="rounded-circle" alt="">
</td>
<td class="v-center text-truncate" style="max-width:200px;">{{ strip_tags($item->description1) }}</td>
<td class="v-center text-truncate" style="max-width:200px;">{{ strip_tags($item->description2) }}</td>
<td class="v-center">{{ $item->name ?? 'N/A' }}</td>
<td class="v-center">
  @if($item->is_active==1)
    <span class="badge bg-success">Active</span>
  @elseif($item->is_active==0)
    <span class="badge bg-danger">Inactive</span>
  @else
    <span class="badge bg-secondary">N/A</span>
  @endif
</td>
            <td class="v-center">
              <a href="{{ route('admin-sub-tree3s.edit', $item->id) }}" class="btn btn-sm btn-success">Edit</a>
              <form action="{{ route('admin-sub-tree3s.destroy', $item->id) }}" method="POST" class="d-inline">
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