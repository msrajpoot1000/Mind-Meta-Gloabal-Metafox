@extends('admin.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst('com-reg-page'))


@section('style')
    <style>
        .multi-select {
            border: 1px solid red !important;
        }

        .multi-select option {
            padding: 0.6rem !important;
        }
    </style>
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

    <div class="mb-2 text-end">
        <button id="toggleButton" class="btn btn-sm btn-success">Create {{ ucfirst('Com Reg Page') }}</button>
    </div>

    <div id="create-form-section">
        <div class="card">
            <div class="card-header">
                <h4>Add {{ ucfirst('Com Reg Page') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin-com-reg-page.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Com Reg <span class="text-danger">*</span></label>
                                <select name="ref_id" class="form-control" required>
                                    <option value="">-- Select --</option>
                                    @foreach ($items1 as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('ref_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="banner_image" class="form-label">Banner Image </label>
                            <input type="file" name="banner_image" id="banner_image"
                                class="form-control preview-image-input @error('banner_image') is-invalid @enderror"
                                data-preview-id="photo_preview_1" accept="image/*">
                            @error('banner_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 d-flex justify-content-center align-items-center">
                            <img id="photo_preview_1" src=""
                                style="max-width:5rem;border:1px solid#ccc;padding:5px; display:none;">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="banner_heading" class="form-label">Banner Heading </label>
                        <input type="text" name="banner_heading" id="banner_heading"
                            class="form-control @error('banner_heading') is-invalid @enderror"
                            value="{{ old('banner_heading') }}">
                        @error('banner_heading')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description1" class="form-label">Banner Description </label>
                        <textarea name="banner_description" id="description1"
                            class="form-control @error('banner_description') is-invalid @enderror" rows="4">{{ old('banner_description') }}</textarea>
                        @error('banner_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description2" class="form-label">Benefits Description </label>
                        <textarea name="benefits_description" id="description2"
                            class="form-control @error('benefits_description') is-invalid @enderror" rows="4">{{ old('benefits_description') }}</textarea>
                        @error('benefits_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description3" class="form-label">Features Description </label>
                        <textarea name="features_description" id="description3"
                            class="form-control @error('features_description') is-invalid @enderror" rows="4">{{ old('features_description') }}</textarea>
                        @error('features_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="overview_heading" class="form-label">Overview Heading <span
                                class="text-danger">*</span></label>
                        <input type="text" name="overview_heading" id="overview_heading"
                            class="form-control @error('overview_heading') is-invalid @enderror"
                            value="{{ old('overview_heading') }}">
                        @error('overview_heading')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description4" class="form-label">Overview Description </label>
                        <textarea name="overview_description" id="description4"
                            class="form-control @error('overview_description') is-invalid @enderror" rows="4">{{ old('overview_description') }}</textarea>
                        @error('overview_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="type_section_heading" class="form-label">Type Section Heading <span
                                class="text-danger">*</span></label>
                        <input type="text" name="type_section_heading" id="type_section_heading"
                            class="form-control @error('type_section_heading') is-invalid @enderror"
                            value="{{ old('type_section_heading') }}">
                        @error('type_section_heading')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description5" class="form-label">Business Legal Description </label>
                        <textarea name="business_legal_description" id="description5"
                            class="form-control @error('business_legal_description') is-invalid @enderror" rows="4">{{ old('business_legal_description') }}</textarea>
                        @error('business_legal_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="step_section_sub_heading" class="form-label">Step Section Sub Heading </label>
                        <input type="text" name="step_section_sub_heading" id="step_section_sub_heading"
                            class="form-control @error('step_section_sub_heading') is-invalid @enderror"
                            value="{{ old('step_section_sub_heading') }}">
                        @error('step_section_sub_heading')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="step_section_heading" class="form-label">Step Section Heading <span
                                class="text-danger">*</span></label>
                        <input type="text" name="step_section_heading" id="step_section_heading"
                            class="form-control @error('step_section_heading') is-invalid @enderror"
                            value="{{ old('step_section_heading') }}">
                        @error('step_section_heading')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description6" class="form-label">Step Section Description </label>
                        <textarea name="step_section_description" id="description6"
                            class="form-control @error('step_section_description') is-invalid @enderror" rows="4">{{ old('step_section_description') }}</textarea>
                        @error('step_section_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="why_section_heading" class="form-label">Why Section Heading <span
                                class="text-danger">*</span></label>
                        <input type="text" name="why_section_heading" id="why_section_heading"
                            class="form-control @error('why_section_heading') is-invalid @enderror"
                            value="{{ old('why_section_heading') }}">
                        @error('why_section_heading')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description7" class="form-label">Why Section Description </label>
                        <textarea name="why_section_description" id="description7"
                            class="form-control @error('why_section_description') is-invalid @enderror" rows="4">{{ old('why_section_description') }}</textarea>
                        @error('why_section_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>




                    {{-- license section  --}}
                    <div class="mb-3">
                        <label for="license_ids" class="form-label">License Section</label>
                        <select name="license_ids[]" id="license_ids"
                            class="multi-select form-select @error('license_ids') is-invalid @enderror" multiple
                            size="5" style="max-height: 150px; overflow-y: auto;">
                            <option disabled style="padding:0.5rem; border-radius: 5px;margin-bottom:0.2rem">Select
                            </option>
                            @foreach ($comRegLicenseSec as $item)
                                <option value="{{ $item->id }}"
                                    {{ collect(old('license_ids'))->contains($item->id) ? 'selected' : '' }}
                                    style="padding:0.5rem;border:1px solid black; border-radius: 5px;margin-bottom:0.2rem">
                                    {{ $item->license_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('license_ids')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- business legal  --}}
                    <div class="mb-3">
                        <label for="faq" class="form-label">Business Legal Section </label>
                        <select name="business_legal_ids[]" id="faq"
                            class="multi-select form-select @error('faq') is-invalid @enderror" multiple size="5"
                            style="max-height: 150px; overflow-y: auto;">
                            <option disabled style="padding:0.5rem; border-radius: 5px;margin-bottom:0.2rem">
                                Select </option>
                            @foreach ($comRegWhySec as $item)
                                <option value="{{ $item->id }}"
                                    {{ collect(old('faq'))->contains($item->id) ? 'selected' : '' }}
                                    style="padding:0.5rem;border:1px solid black; border-radius: 5px;margin-bottom:0.2rem">
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>



                        @error('faq')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- reequrie doc  --}}
                    <div class="mb-3">
                        <label for="require_doc_ids" class="form-label">Require Doc</label>
                        <select name="require_doc_ids[]" id="require_doc_ids"
                            class="multi-select form-select @error('require_doc_ids') is-invalid @enderror" multiple
                            size="5" style="max-height: 150px; overflow-y: auto;">
                            <option disabled style="padding:0.5rem; border-radius: 5px;margin-bottom:0.2rem">Select
                            </option>
                            @foreach ($comRegRequireDocSec as $item)
                                <option value="{{ $item->id }}"
                                    {{ collect(old('require_doc_ids'))->contains($item->id) ? 'selected' : '' }}
                                    style="padding:0.5rem;border:1px solid black; border-radius: 5px;margin-bottom:0.2rem">
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('require_doc_ids')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- step s  --}}
                    <div class="mb-3">
                        <label for="faq" class="form-label">Step Section </label>
                        <select name="step_ids[]" id="faq"
                            class="multi-select form-select @error('faq') is-invalid @enderror" multiple size="5"
                            style="max-height: 150px; overflow-y: auto;">
                            <option disabled style="padding:0.5rem; border-radius: 5px;margin-bottom:0.2rem">
                                Select Step</option>
                            @foreach ($comRegStepSec as $item)
                                <option value="{{ $item->id }}"
                                    {{ collect(old('items'))->contains($item->id) ? 'selected' : '' }}
                                    style="padding:0.5rem;border:1px solid black; border-radius: 5px;margin-bottom:0.2rem">
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>



                        @error('faq')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- why section  --}}
                    <div class="mb-3">
                        <label for="faq" class="form-label">Why Section </label>
                        <select name="why_ids[]" id="faq"
                            class="multi-select form-select @error('faq') is-invalid @enderror" multiple size="5"
                            style="max-height: 150px; overflow-y: auto;">
                            <option disabled style="padding:0.5rem; border-radius: 5px;margin-bottom:0.2rem">
                                Select </option>
                            @foreach ($comRegWhySec as $item)
                                <option value="{{ $item->id }}"
                                    {{ collect(old('faq'))->contains($item->id) ? 'selected' : '' }}
                                    style="padding:0.5rem;border:1px solid black; border-radius: 5px;margin-bottom:0.2rem">
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>



                        @error('faq')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- faq section  --}}
                    <div class="mb-3">
                        <label for="faq" class="form-label">FAQ </label>
                        <select name="faq_ids[]" id="faq"
                            class="multi-select form-select @error('faq') is-invalid @enderror" multiple size="5"
                            style="max-height: 150px; overflow-y: auto;">
                            <option disabled style="padding:0.5rem; border-radius: 5px;margin-bottom:0.2rem">
                                Select FAQ(s)</option>
                            @foreach ($comRegFaqSec as $item)
                                <option value="{{ $item->id }}"
                                    {{ collect(old('faq'))->contains($item->id) ? 'selected' : '' }}
                                    style="padding:0.5rem;border:1px solid black; border-radius: 5px;margin-bottom:0.2rem">
                                    {{ $item->ques }}
                                </option>
                            @endforeach
                        </select>
                    </div>




                    <div class="mb-3">
                        <label for="is_active" class="form-label">Is Active</label>
                        <select name="is_active" id="is_active"
                            class="form-select @error('is_active') is-invalid @enderror">
                            <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('is_active')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                    @error('faq')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
            </div>



            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
    </div>

    <div class="mt-4 card">
        <div class="card-header">
            <h4>All {{ ucfirst('Com Reg Page') }}</h4>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>SN.</th>
                        <th>Com Reg</th>
                        <th>Name</th>
                        <th>Banner Image</th>
                        <th>Banner Heading</th>
                        <th>Banner Description</th>
                        <th>Benefits Description</th>
                        <th>Features Description</th>
                        <th>Overview Heading</th>
                        <th>Overview Description</th>
                        <th>Type Section Heading</th>
                        <th>Business Legal Description</th>
                        <th>Step Section Sub Heading</th>
                        <th>Step Section Heading</th>
                        <th>Step Section Description</th>
                        <th>Why Section Heading</th>
                        <th>Why Section Description</th>
                        <th>Is Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items2 as $item)
                        <tr>
                            <td class="v-center">{{ $loop->iteration }}</td>
                            <td class="v-center">{{ $item->comReg->name ?? 'N/A' }}</td>
                            <td class="v-center">{{ $item->name ?? 'N/A' }}</td>
                            <td class="v-center">
                                <img src="{{ asset($item->banner_image) }}" width="60" height="60"
                                    class="rounded-circle" alt="">
                            </td>
                            <td class="v-center">{{ $item->banner_heading ?? 'N/A' }}</td>
                            <td class="v-center text-truncate" style="max-width:200px;">
                                {{ strip_tags($item->banner_description) }}</td>
                            <td class="v-center text-truncate" style="max-width:200px;">
                                {{ strip_tags($item->benefits_description) }}</td>
                            <td class="v-center text-truncate" style="max-width:200px;">
                                {{ strip_tags($item->features_description) }}</td>
                            <td class="v-center">{{ $item->overview_heading ?? 'N/A' }}</td>
                            <td class="v-center text-truncate" style="max-width:200px;">
                                {{ strip_tags($item->overview_description) }}</td>
                            <td class="v-center">{{ $item->type_section_heading ?? 'N/A' }}</td>
                            <td class="v-center text-truncate" style="max-width:200px;">
                                {{ strip_tags($item->business_legal_description) }}</td>
                            <td class="v-center">{{ $item->step_section_sub_heading ?? 'N/A' }}</td>
                            <td class="v-center">{{ $item->step_section_heading ?? 'N/A' }}</td>
                            <td class="v-center text-truncate" style="max-width:200px;">
                                {{ strip_tags($item->step_section_description) }}</td>
                            <td class="v-center">{{ $item->why_section_heading ?? 'N/A' }}</td>
                            <td class="v-center text-truncate" style="max-width:200px;">
                                {{ strip_tags($item->why_section_description) }}</td>
                            <td class="v-center">
                                @if ($item->is_active == 1)
                                    <span class="badge bg-success">Active</span>
                                @elseif($item->is_active == 0)
                                    <span class="badge bg-danger">Inactive</span>
                                @else
                                    <span class="badge bg-secondary">N/A</span>
                                @endif
                            </td>
                            <td class="v-center">
                                <a href="{{ route('admin-com-reg-page.edit', $item->id) }}"
                                    class="btn btn-sm btn-success">Edit</a>
                                <form action="{{ route('admin-com-reg-page.destroy', $item->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
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
@endsection
