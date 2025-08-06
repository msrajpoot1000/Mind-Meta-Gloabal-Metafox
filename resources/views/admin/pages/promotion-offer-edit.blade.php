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

            fetch(`/get-promotion-pages/${programId}`)
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
                <form action="{{ route('admin-promotion-offer.update', $item3->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="programSelect">Promotion <span class="astrick">*</span></label>
            <select name="head_ref_id" class="form-control" id="programSelect" requried>
                <option value="">-- Select Promotion --</option>
                @foreach ($items1 as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $item1Id ? 'selected' : '' }}>{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label for="subProgramSelect">Promotion Page <span class="astrick">*</span></label>
            <select name="ref_id" class="form-control" id="subProgramSelect" required>
                <option value="">-- Select Promotion Page --</option>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="offer_image" class="form-label">Offer Image</label>
            <input type="file" class="form-control preview-image-input @error('offer_image') is-invalid @enderror" name="offer_image" id="offer_image" data-preview-id="photo_preview_offer_image" accept="image/*">
            @error('offer_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
    <div class="col-md-6 d-flex align-items-center justify-content-center">
        <img id="photo_preview_offer_image" src="{{ asset($item3->offer_image) }}" alt="Selected Image" style="max-width: 5rem; border: 1px solid #ccc; padding: 5px;">
        <input type="hidden" name="status_offer_image" id="status_offer_image" value="1">
        <button type="button" id="statusPhotoBtn_offer_image" class="btn btn-danger btn-sm m-2">
            <i class="fas fa-trash"></i> Delete Image
        </button>
    </div>
</div>

<div class="mb-3">
    <label for="offer_title" class="form-label">Offer Title <span class="astrick">*</span></label>
    <input type="text" name="offer_title" id="offer_title" class="form-control @error('offer_title') is-invalid @enderror" value="{{ old('offer_title', $item3->offer_title ?? '') }}">
    @error('offer_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="offer_price" class="form-label">Offer Price</label>
    <input type="text" name="offer_price" id="offer_price" class="form-control @error('offer_price') is-invalid @enderror" value="{{ old('offer_price', $item3->offer_price ?? '') }}">
    @error('offer_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="description1" class="form-label">Offer Description</label>
    <textarea name="offer_description" id="description1" class="form-control @error('offer_description') is-invalid @enderror" rows="4">{{ old('offer_description', $item3->offer_description ?? '') }}</textarea>
    @error('offer_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
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