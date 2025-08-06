@extends('admin.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst('promotion-offer'))

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('programSelect').addEventListener('change', function () {
            const programId = this.value;
            const subProgramSelect = document.getElementById('subProgramSelect');
            subProgramSelect.innerHTML = '<option value="">-- Loading... --</option>';

            if (programId) {
                fetch(`/get-promotion-pages/${programId}`)
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
    <button id="toggleButton" class="btn btn-sm btn-success px-4 fs-5">Create {{ ucfirst('Promotion Offer') }}</button>
</div>

<div id="create-form-section">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Add {{ ucfirst('Promotion Offer') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin-promotion-offer.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Promotion <span
                                                class="astrick">*</span></label>
                                <select name="head_ref_id" class="form-control" id="programSelect" required>
                                    <option value="">-- Select Promotion --</option>
                                    @foreach ($items1 as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Promotion Page <span
                                                class="astrick">*</span></label>
                                <select name="ref_id" class="form-control" id="subProgramSelect" required>
                                    <option value="">-- Select Promotion Page --</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
  <div class="col-md-6 mb-3">
    <label for="offer_image" class="form-label">Offer Image</label>
    <input type="file" name="offer_image" id="offer_image" class="form-control preview-image-input @error('offer_image') is-invalid @enderror" data-preview-id="photo_preview_1" accept="image/*">
    @error('offer_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
  <div class="col-md-6 d-flex justify-content-center align-items-center">
    <img id="photo_preview_1" src="" style="max-width:5rem;border:1px solid#ccc;padding:5px; display:none;">
  </div>
</div>

<div class="mb-3">
    <label for="offer_title" class="form-label">Offer Title <span class="text-danger">*</span></label>
    <input type="text" name="offer_title" id="offer_title" value="{{ old('offer_title') }}" class="form-control @error('offer_title') is-invalid @enderror">
    @error('offer_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="offer_price" class="form-label">Offer Price</label>
    <input type="text" name="offer_price" id="offer_price" value="{{ old('offer_price') }}" class="form-control @error('offer_price') is-invalid @enderror">
    @error('offer_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="description1" class="form-label">Offer Description</label>
    <textarea name="offer_description" id="description1" rows="4" class="form-control @error('offer_description') is-invalid @enderror">{{ old('offer_description') }}</textarea>
    @error('offer_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                <h4 class="card-title">All {{ ucfirst('Promotion Offer') }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>SN.</th>
                                <th>Promotion</th>
                                <th>Promotion Page</th>
                                <th>Offer Image</th>
<th>Offer Title</th>
<th>Offer Price</th>
<th>Offer Description</th>
<th>Is Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items3 as $item)
                                <tr>
                                    <td class="v-center">{{ $loop->iteration }}</td>
                                    <td class="v-center">{{ $item->{Str::camel('PromotionPage')}->{Str::camel('Promotion')}->name ?? 'N/A' }}</td>
<td class="v-center">{{ $item->{Str::camel('PromotionPage')}->name ?? 'N/A' }}</td>
                                    <td class="v-center">
    <img src="{{ asset($item->offer_image) }}" width="60" height="60" class="rounded-circle" alt="no image">
</td>
<td class="v-center">{{ $item->offer_title ?? 'N/A' }}</td>
<td class="v-center">{{ $item->offer_price ?? 'N/A' }}</td>
<td class="v-center" style="vertical-align: middle;">
    <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
        {{ strip_tags($item->offer_description) }}
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
                                        <a href="{{ route('admin-promotion-offer.edit', $item->id) }}" class="btn btn-sm btn-success">Edit</a>
                                        <form action="{{ route('admin-promotion-offer.destroy', $item->id) }}" method="POST" style="display:inline-block;">
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