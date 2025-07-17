@extends('admin.layouts.app')

@section('title', 'Dashboard | Edit Item')

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const programSelect = document.getElementById('programSelect');
        const subProgramSelect = document.getElementById('subProgramSelect');
        const selectedSubProgramId = "{{ $item2Id ?? '' }}";

        function loadSubPrograms(programId, preselectedId = null) {
            if (!programId) {
                subProgramSelect.innerHTML = '<option value="">-- Select Sub Program --</option>';
                return;
            }

            subProgramSelect.innerHTML = '<option value="">-- Loading... --</option>';

            fetch(`/get-sub-tree2s/${programId}`)
                .then(response => response.json())
                .then(data => {
                    subProgramSelect.innerHTML = '<option value="">-- Select Sub Program --</option>';
                    data.forEach(sub => {
                        const option = document.createElement('option');
                        option.value = sub.id;
                        option.textContent = sub.name;
                        if (preselectedId && sub.id == preselectedId) {
                            option.selected = true;
                        }
                        subProgramSelect.appendChild(option);
                    });
                })
                .catch(() => {
                    subProgramSelect.innerHTML = '<option value="">-- Error Loading --</option>';
                });
        }

        programSelect.addEventListener('change', function () {
            loadSubPrograms(this.value);
        });

        if (programSelect.value) {
            loadSubPrograms(programSelect.value, selectedSubProgramId);
        }
    });
</script>
@endsection

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
                <form action="{{ route('admin-sub-sub-tree4s.update', $item3->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="programSelect">Tree1 <span class="astrick">*</span></label>
            <select name="head_ref_id" class="form-control" id="programSelect">
                <option value="">-- Select Tree1 --</option>
                @foreach ($items1 as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $item1Id ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="subProgramSelect">Sub Tree2 <span class="astrick">*</span></label>
            <select name="ref_id" class="form-control" id="subProgramSelect">
                <option value="">-- Select Sub Tree2 --</option>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="photo" class="form-label">Photo <span class="astrick">*</span></label>
            <input type="file" class="form-control preview-image-input @error('photo') is-invalid @enderror" name="photo" id="photo" data-preview-id="photo_preview_photo" accept="image/*">
            @error('photo')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-6 d-flex align-items-center justify-content-center">
        <img id="photo_preview_photo" src="{{ asset($item3->photo) }}" alt="Selected Image" style="max-width: 5rem; border: 1px solid #ccc; padding: 5px;">
        <input type="hidden" name="status_photo" id="status_photo" value="1">
        <button type="button" id="statusPhotoBtn_photo" class="btn btn-danger btn-sm m-2">
            <i class="fas fa-trash"></i> Delete Image
        </button>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="photo2" class="form-label">Photo2</label>
            <input type="file" class="form-control preview-image-input @error('photo2') is-invalid @enderror" name="photo2" id="photo2" data-preview-id="photo_preview_photo2" accept="image/*">
            @error('photo2')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-6 d-flex align-items-center justify-content-center">
        <img id="photo_preview_photo2" src="{{ asset($item3->photo2) }}" alt="Selected Image" style="max-width: 5rem; border: 1px solid #ccc; padding: 5px;">
        <input type="hidden" name="status_photo2" id="status_photo2" value="1">
        <button type="button" id="statusPhotoBtn_photo2" class="btn btn-danger btn-sm m-2">
            <i class="fas fa-trash"></i> Delete Image
        </button>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="photo33" class="form-label">Photo33 <span class="astrick">*</span></label>
            <input type="file" class="form-control preview-image-input @error('photo33') is-invalid @enderror" name="photo33" id="photo33" data-preview-id="photo_preview_photo33" accept="image/*">
            @error('photo33')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-6 d-flex align-items-center justify-content-center">
        <img id="photo_preview_photo33" src="{{ asset($item3->photo33) }}" alt="Selected Image" style="max-width: 5rem; border: 1px solid #ccc; padding: 5px;">
        <input type="hidden" name="status_photo33" id="status_photo33" value="1">
        <button type="button" id="statusPhotoBtn_photo33" class="btn btn-danger btn-sm m-2">
            <i class="fas fa-trash"></i> Delete Image
        </button>
    </div>
</div>

<div class="mb-3">
    <label for="description1" class="form-label">Description1 <span class="astrick">*</span></label>
    <textarea name="description1" id="description1" class="form-control @error('description1') is-invalid @enderror" rows="4">{{ old('description1', $item3->description1 ?? '') }}</textarea>
    @error('description1')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="description2" class="form-label">Description2</label>
    <textarea name="description2" id="description2" class="form-control @error('description2') is-invalid @enderror" rows="4">{{ old('description2', $item3->description2 ?? '') }}</textarea>
    @error('description2')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="name" class="form-label">Name <span class="astrick">*</span></label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $item3->name ?? '') }}">
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="is_active" class="form-label">Is Active</label>
    <select name="is_active" id="is_active" class="form-select @error('is_active') is-invalid @enderror">
        <option value="1" {{ old('is_active', $item3->is_active) == '1' ? 'selected' : '' }}>Active</option>
        <option value="0" {{ old('is_active', $item3->is_active) == '0' ? 'selected' : '' }}>Inactive</option>
    </select>
    @error('is_active')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<!-- Unknown field type: belongsTo -->

<!-- Unknown field type: belongsTo -->

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary w-md">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection