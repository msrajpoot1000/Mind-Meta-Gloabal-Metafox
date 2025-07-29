@extends('admin.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst('service-page'))

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
        <button id="toggleButton" class="btn btn-sm btn-success">Create {{ ucfirst('Service Page') }}</button>
    </div>

    <div id="create-form-section">
        <div class="card">
            <div class="card-header">
                <h4>Add {{ ucfirst('Service Page') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin-service-page.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Service <span class="text-danger">*</span></label>
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

                    <div class="mb-3">
                        <label for="description1" class="form-label">Description </label>
                        <textarea name="description" id="description1" class="form-control @error('description') is-invalid @enderror"
                            rows="4">{{ old('description') }}</textarea>
                        @error('description')
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
                        <label for="description2" class="form-label">Banner Description </label>
                        <textarea name="banner_description" id="description2"
                            class="form-control @error('banner_description') is-invalid @enderror" rows="4">{{ old('banner_description') }}</textarea>
                        @error('banner_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description3" class="form-label">Extra Section </label>
                        <textarea name="extra_section" id="description3" class="form-control @error('extra_section') is-invalid @enderror"
                            rows="4">{{ old('extra_section') }}</textarea>
                        @error('extra_section')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="license_section_heading" class="form-label">License Section Heading </label>
                        <input type="text" name="license_section_heading" id="license_section_heading"
                            class="form-control @error('license_section_heading') is-invalid @enderror"
                            value="{{ old('license_section_heading') }}">
                        @error('license_section_heading')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="business_legal_heading" class="form-label">Business Legal Heading </label>
                        <input type="text" name="business_legal_heading" id="business_legal_heading"
                            class="form-control @error('business_legal_heading') is-invalid @enderror"
                            value="{{ old('business_legal_heading') }}">
                        @error('business_legal_heading')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description4" class="form-label">Business Legal Description </label>
                        <textarea name="business_legal_description" id="description4"
                            class="form-control @error('business_legal_description') is-invalid @enderror" rows="4">{{ old('business_legal_description') }}</textarea>
                        @error('business_legal_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="why_section_heading" class="form-label">Why Section Heading </label>
                        <input type="text" name="why_section_heading" id="why_section_heading"
                            class="form-control @error('why_section_heading') is-invalid @enderror"
                            value="{{ old('why_section_heading') }}">
                        @error('why_section_heading')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description5" class="form-label">Why Section Description </label>
                        <textarea name="why_section_description" id="description5"
                            class="form-control @error('why_section_description') is-invalid @enderror" rows="4">{{ old('why_section_description') }}</textarea>
                        @error('why_section_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="benefit_heading" class="form-label">Benefit Heading </label>
                        <input type="text" name="benefit_heading" id="benefit_heading"
                            class="form-control @error('benefit_heading') is-invalid @enderror"
                            value="{{ old('benefit_heading') }}">
                        @error('benefit_heading')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description6" class="form-label">Benefits Description </label>
                        <textarea name="benefits_description" id="description6"
                            class="form-control @error('benefits_description') is-invalid @enderror" rows="4">{{ old('benefits_description') }}</textarea>
                        @error('benefits_description')
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
                            @foreach ($serviceLicenseSec as $item)
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
                        <select name="business_legal_ids[]" id="business_legal_ids"
                            class="multi-select form-select @error('business_legal_ids') is-invalid @enderror" multiple size="5"
                            style="max-height: 150px; overflow-y: auto;">
                            <option disabled style="padding:0.5rem; border-radius: 5px;margin-bottom:0.2rem">
                                Select </option>
                            @foreach ($serviceBusinessLegalSec as $item)
                                <option value="{{ $item->id }}"
                                    {{ collect(old('business_legal_ids'))->contains($item->id) ? 'selected' : '' }}
                                    style="padding:0.5rem;border:1px solid black; border-radius: 5px;margin-bottom:0.2rem">
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('business_legal_ids')
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
                            @foreach ($serviceRequireDocSec as $item)
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
                            @foreach ($serviceStepSec as $item)
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
                            @foreach ($serviceWhySec as $item)
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
                            @foreach ($serviceFaqSec as $item)
                                <option value="{{ $item->id }}"
                                    {{ collect(old('faq'))->contains($item->id) ? 'selected' : '' }}
                                    style="padding:0.5rem;border:1px solid black; border-radius: 5px;margin-bottom:0.2rem">
                                    {{ $item->ques }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- benefit section  --}}
                    <div class="mb-3">
                        <label for="faq" class="form-label">Benefit </label>
                        <select name="benefit_ids[]" id="faq"
                            class="multi-select form-select @error('faq') is-invalid @enderror" multiple size="5"
                            style="max-height: 150px; overflow-y: auto;">
                            <option disabled style="padding:0.5rem; border-radius: 5px;margin-bottom:0.2rem">
                                Select Benefit(s)</option>
                            @foreach ($serviceBenefitSec as $item)
                                <option value="{{ $item->id }}"
                                    {{ collect(old('faq'))->contains($item->id) ? 'selected' : '' }}
                                    style="padding:0.5rem;border:1px solid black; border-radius: 5px;margin-bottom:0.2rem">
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>





                    <div class="mb-3">
                        <label for="is_active" class="form-label">Is Active </label>
                        <select name="is_active" id="is_active"
                            class="form-select @error('is_active') is-invalid @enderror">
                            <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('is_active')
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
            <h4>All {{ ucfirst('Service Page') }}</h4>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>SN.</th>
                        <th>Service</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Banner Image</th>
                        <th>Banner Heading</th>
                        <th>Banner Description</th>
                        <th>Extra Section</th>
                        <th>License Section Heading</th>
                        <th>Business Legal Heading</th>
                        <th>Business Legal Description</th>
                        <th>Why Section Heading</th>
                        <th>Why Section Description</th>
                        <th>Benefit Heading</th>
                        <th>Benefits Description</th>
                        <th>Is Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items2 as $item)
                        <tr>
                            <td class="v-center">{{ $loop->iteration }}</td>
                            <td class="v-center">{{ $item->service->name ?? 'N/A' }}</td>
                            <td class="v-center">{{ $item->name ?? 'N/A' }}</td>
                            <td class="v-center text-truncate" style="max-width:200px;">
                                {{ strip_tags($item->description) }}</td>
                            <td class="v-center">
                                <img src="{{ asset($item->banner_image) }}" width="60" height="60"
                                    class="rounded-circle" alt="">
                            </td>
                            <td class="v-center">{{ $item->banner_heading ?? 'N/A' }}</td>
                            <td class="v-center text-truncate" style="max-width:200px;">
                                {{ strip_tags($item->banner_description) }}</td>
                            <td class="v-center text-truncate" style="max-width:200px;">
                                {{ strip_tags($item->extra_section) }}</td>
                            <td class="v-center">{{ $item->license_section_heading ?? 'N/A' }}</td>
                            <td class="v-center">{{ $item->business_legal_heading ?? 'N/A' }}</td>
                            <td class="v-center text-truncate" style="max-width:200px;">
                                {{ strip_tags($item->business_legal_description) }}</td>
                            <td class="v-center">{{ $item->why_section_heading ?? 'N/A' }}</td>
                            <td class="v-center text-truncate" style="max-width:200px;">
                                {{ strip_tags($item->why_section_description) }}</td>
                            <td class="v-center">{{ $item->benefit_heading ?? 'N/A' }}</td>
                            <td class="v-center text-truncate" style="max-width:200px;">
                                {{ strip_tags($item->benefits_description) }}</td>
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
                                <a href="{{ route('admin-service-page.edit', $item->id) }}"
                                    class="btn btn-sm btn-success">Edit</a>
                                <form action="{{ route('admin-service-page.destroy', $item->id) }}" method="POST"
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
