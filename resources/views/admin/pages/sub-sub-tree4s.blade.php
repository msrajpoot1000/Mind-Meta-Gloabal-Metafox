@extends('admin.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst('sub-sub-tree4s'))

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('programSelect').addEventListener('change', function () {
            const programId = this.value;
            const subProgramSelect = document.getElementById('subProgramSelect');
            subProgramSelect.innerHTML = '<option value="">-- Loading... --</option>';

            if (programId) {
                fetch(`/get-sub-tree2s/${programId}`)
                    .then(response => response.json())
                    .then(data => {
                        subProgramSelect.innerHTML = '<option value="">-- Select Sub Program     --</option>';
                        data.forEach(sub => {
                            const option = document.createElement('option');
                            option.value = sub.id;
                            option.textContent = sub.name;
                            subProgramSelect.appendChild(option);
                        });
                    })
                    .catch(() => {
                        subProgramSelect.innerHTML = '<option value="">-- Error Loading --</option>';
                    });
            } else {
                subProgramSelect.innerHTML = '<option value="">-- Select Sub Program --</option>';
            }
        });
    });
</script>
@endsection

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
    <button id="toggleButton" class="btn btn-sm btn-success px-4 fs-5">Create {{ ucfirst('sub-sub-tree4s') }}</button>
</div>

<div id="create-form-section">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Add {{ ucfirst('sub-sub-tree4s') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin-sub-sub-tree4s.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Tree1 <span
                                                class="astrick">*</span></label>
                                <select name="head_ref_id" class="form-control" id="programSelect" required>
                                    <option value="">-- Select Tree1 --</option>
                                    @foreach ($items1 as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Sub Tree2 <span
                                                class="astrick">*</span></label>
                                <select name="ref_id" class="form-control" id="subProgramSelect" required>
                                    <option value="">-- Select Sub Tree2 --</option>
                                </select>
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
    <label for="photo2" class="form-label">Photo2</label>
    <input type="file" name="photo2" id="photo2" class="form-control preview-image-input @error('photo2') is-invalid @enderror" data-preview-id="photo_preview_2" accept="image/*">
    @error('photo2')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="col-md-6 d-flex justify-content-center align-items-center">
    <img id="photo_preview_2" src="" style="max-width:5rem;border:1px solid#ccc;padding:5px; display:none;">
  </div>
</div>

<div class="row">
  <div class="col-md-6 mb-3">
    <label for="photo33" class="form-label">Photo33 <span class="text-danger">*</span></label>
    <input type="file" name="photo33" id="photo33" class="form-control preview-image-input @error('photo33') is-invalid @enderror" data-preview-id="photo_preview_3" accept="image/*">
    @error('photo33')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="col-md-6 d-flex justify-content-center align-items-center">
    <img id="photo_preview_3" src="" style="max-width:5rem;border:1px solid#ccc;padding:5px; display:none;">
  </div>
</div>

<div class="mb-3">
    <label for="description1" class="form-label">Description1 <span class="text-danger">*</span></label>
    <textarea name="description1" id="description1" rows="4" class="form-control @error('description1') is-invalid @enderror">{{ old('description1') }}</textarea>
    @error('description1')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="description2" class="form-label">Description2</label>
    <textarea name="description2" id="description2" rows="4" class="form-control @error('description2') is-invalid @enderror">{{ old('description2') }}</textarea>
    @error('description2')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
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
                <h4 class="card-title">All {{ ucfirst('sub-sub-tree4s') }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>SN.</th>
                                <th>Tree1</th>
                                <th>Sub Tree2</th>
                                <th>Photo</th>
<th>Photo2</th>
<th>Photo33</th>
<th>Description1</th>
<th>Description2</th>
<th>Name</th>
<th>Is Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items3 as $item)
                                <tr>
                                    <td class="v-center">{{ $loop->iteration }}</td>
                                    <td class="v-center">{{ $item->{Str::camel('SubTree2')}->{Str::camel('Tree1')}->name ?? 'N/A' }}</td>
<td class="v-center">{{ $item->{Str::camel('SubTree2')}->name ?? 'N/A' }}</td>
                                    <td class="v-center">
    <img src="{{ asset($item->photo) }}" width="60" height="60" class="rounded-circle" alt="no image">
</td>
<td class="v-center">
    <img src="{{ asset($item->photo2) }}" width="60" height="60" class="rounded-circle" alt="no image">
</td>
<td class="v-center">
    <img src="{{ asset($item->photo33) }}" width="60" height="60" class="rounded-circle" alt="no image">
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
                                        <a href="{{ route('admin-sub-sub-tree4s.edit', $item->id) }}" class="btn btn-sm btn-success">Edit</a>
                                        <form action="{{ route('admin-sub-sub-tree4s.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%" class="text-center">No Data Available</td>
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