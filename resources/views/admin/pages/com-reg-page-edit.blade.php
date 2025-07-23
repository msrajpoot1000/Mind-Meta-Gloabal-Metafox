@extends('admin.layouts.app')

@section('title', 'Dashboard | Edit Item')

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll("select[data-order-select]").forEach(select => {
                const hiddenContainerId = select.dataset.hiddenContainer;
                const hiddenContainer = document.getElementById(hiddenContainerId);
                const inputName = select.dataset.name;

                let selectedValues = [];

                // Initialize from pre-selected options
                Array.from(select.options).forEach(option => {
                    if (option.selected) selectedValues.push(option.value);
                });

                function updateHiddenInputs() {
                    hiddenContainer.innerHTML = '';
                    selectedValues.forEach(value => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = inputName;
                        input.value = value;
                        hiddenContainer.appendChild(input);
                    });
                }

                select.addEventListener("mousedown", function(e) {
                    if (e.target.tagName.toLowerCase() === 'option') {
                        e.preventDefault();
                        const option = e.target;
                        const value = option.value;
                        const index = selectedValues.indexOf(value);

                        if (index > -1) {
                            selectedValues.splice(index, 1);
                            option.selected = false;
                        } else {
                            selectedValues.push(value);
                            option.selected = true;
                        }

                        updateHiddenInputs();
                    }
                });

                updateHiddenInputs(); // initial call
            });
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

                    <form action="{{ route('admin-com-reg-page.update', $item2->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Com Reg Page <span class="text-danger">*</span></label>
                                    <select name="ref_id" class="form-control" required>
                                        <option value="">-- Select --</option>
                                        @foreach ($items1 as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('ref_id', $item2->ref_id ?? '') == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $item2->name ?? '') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="banner_image" class="form-label">Banner Image </label>
                                    <input type="file"
                                        class="form-control preview-image-input @error('banner_image') is-invalid @enderror"
                                        name="banner_image" id="banner_image" data-preview-id="photo_preview_banner_image"
                                        accept="image/*">
                                    @error('banner_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 d-flex align-items-center justify-content-center">
                                <img id="photo_preview_banner_image" src="{{ asset($item2->banner_image) }}" alt="No Image"
                                    style="max-width: 5rem; border: 1px solid #ccc; padding: 5px;">
                                <input type="hidden" name="status_banner_image" id="status_banner_image"
                                    value="{{ $item2->banner_image ? 1 : 0 }}">
                                <button type="button" id="statusPhotoBtn_banner_image" class="btn btn-danger btn-sm m-2">
                                    <i class="fas fa-trash"></i> Delete Image
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="banner_heading" class="form-label">Banner Heading </label>
                            <input type="text" name="banner_heading" id="banner_heading"
                                class="form-control @error('banner_heading') is-invalid @enderror"
                                value="{{ old('banner_heading', $item2->banner_heading ?? '') }}">
                            @error('banner_heading')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description1" class="form-label">Banner Description </label>
                            <textarea name="banner_description" id="description1"
                                class="form-control @error('banner_description') is-invalid @enderror" rows="4">{{ old('banner_description', $item2->banner_description ?? '') }}</textarea>
                            @error('banner_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description2" class="form-label">Benefits Description </label>
                            <textarea name="benefits_description" id="description2"
                                class="form-control @error('benefits_description') is-invalid @enderror" rows="4">{{ old('benefits_description', $item2->benefits_description ?? '') }}</textarea>
                            @error('benefits_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description3" class="form-label">Features Description </label>
                            <textarea name="features_description" id="description3"
                                class="form-control @error('features_description') is-invalid @enderror" rows="4">{{ old('features_description', $item2->features_description ?? '') }}</textarea>
                            @error('features_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="overview_heading" class="form-label">Overview Heading <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="overview_heading" id="overview_heading"
                                class="form-control @error('overview_heading') is-invalid @enderror"
                                value="{{ old('overview_heading', $item2->overview_heading ?? '') }}">
                            @error('overview_heading')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description4" class="form-label">Overview Description </label>
                            <textarea name="overview_description" id="description4"
                                class="form-control @error('overview_description') is-invalid @enderror" rows="4">{{ old('overview_description', $item2->overview_description ?? '') }}</textarea>
                            @error('overview_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type_section_heading" class="form-label">Type Section Heading <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="type_section_heading" id="type_section_heading"
                                class="form-control @error('type_section_heading') is-invalid @enderror"
                                value="{{ old('type_section_heading', $item2->type_section_heading ?? '') }}">
                            @error('type_section_heading')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description5" class="form-label">Business Legal Description </label>
                            <textarea name="business_legal_description" id="description5"
                                class="form-control @error('business_legal_description') is-invalid @enderror" rows="4">{{ old('business_legal_description', $item2->business_legal_description ?? '') }}</textarea>
                            @error('business_legal_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="step_section_sub_heading" class="form-label">Step Section Sub Heading </label>
                            <input type="text" name="step_section_sub_heading" id="step_section_sub_heading"
                                class="form-control @error('step_section_sub_heading') is-invalid @enderror"
                                value="{{ old('step_section_sub_heading', $item2->step_section_sub_heading ?? '') }}">
                            @error('step_section_sub_heading')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="step_section_heading" class="form-label">Step Section Heading <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="step_section_heading" id="step_section_heading"
                                class="form-control @error('step_section_heading') is-invalid @enderror"
                                value="{{ old('step_section_heading', $item2->step_section_heading ?? '') }}">
                            @error('step_section_heading')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description6" class="form-label">Step Section Description </label>
                            <textarea name="step_section_description" id="description6"
                                class="form-control @error('step_section_description') is-invalid @enderror" rows="4">{{ old('step_section_description', $item2->step_section_description ?? '') }}</textarea>
                            @error('step_section_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="why_section_heading" class="form-label">Why Section Heading <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="why_section_heading" id="why_section_heading"
                                class="form-control @error('why_section_heading') is-invalid @enderror"
                                value="{{ old('why_section_heading', $item2->why_section_heading ?? '') }}">
                            @error('why_section_heading')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description7" class="form-label">Why Section Description </label>
                            <textarea name="why_section_description" id="description7"
                                class="form-control @error('why_section_description') is-invalid @enderror" rows="4">{{ old('why_section_description', $item2->why_section_description ?? '') }}</textarea>
                            @error('why_section_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>



                        {{-- License Section --}}
                        <div class="mb-3">
                            @php
                                $selectedLicense = old('license_ids', json_decode($item2->license_ids ?? '[]', true));
                            @endphp
                            <label for="license_ids" class="form-label">License Section</label>
                            <select id="license_ids"
                                class="multi-select form-select @error('license_ids') is-invalid @enderror" multiple
                                size="5" style="max-height: 150px; overflow-y: auto;" data-order-select
                                data-name="license_ids[]" data-hidden-container="license_hidden_inputs">
                                @foreach ($comRegLicenseSec as $item)
                                    <option value="{{ $item->id }}"
                                        {{ in_array($item->id, $selectedLicense) ? 'selected' : '' }}
                                        style="padding:0.5rem;border:1px solid black; border-radius: 5px;margin-bottom:0.2rem">
                                        {{ $item->license_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div id="license_hidden_inputs"></div>

                            @error('license_ids')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Business Legal Section --}}
                        <div class="mb-3">
                            @php
                                $selectedBusinessLegal = old(
                                    'business_legal_ids',
                                    json_decode($item2->business_legal_ids ?? '[]', true),
                                );
                            @endphp
                            <label for="business_legal_ids" class="form-label">Business Legal Section</label>
                            <select id="business_legal_ids"
                                class="multi-select form-select @error('business_legal_ids') is-invalid @enderror"
                                multiple size="5" style="max-height: 150px; overflow-y: auto;" data-order-select
                                data-name="business_legal_ids[]" data-hidden-container="business_hidden_inputs">
                                @foreach ($comRegBusinessLegalSec as $item)
                                    <option value="{{ $item->id }}"
                                        {{ in_array($item->id, $selectedBusinessLegal) ? 'selected' : '' }}
                                        style="padding:0.5rem;border:1px solid black; border-radius: 5px;margin-bottom:0.2rem">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div id="business_hidden_inputs"></div>

                            @error('business_legal_ids')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Require Doc Section --}}
                        <div class="mb-3">
                            @php
                                $selectedDocs = old(
                                    'require_doc_ids',
                                    json_decode($item2->require_doc_ids ?? '[]', true),
                                );
                            @endphp
                            <label for="require_doc_ids" class="form-label">Require Doc</label>
                            <select id="require_doc_ids"
                                class="multi-select form-select @error('require_doc_ids') is-invalid @enderror" multiple
                                size="5" style="max-height: 150px; overflow-y: auto;" data-order-select
                                data-name="require_doc_ids[]" data-hidden-container="require_doc_hidden_inputs">
                                @foreach ($comRegRequireDocSec as $item)
                                    <option value="{{ $item->id }}"
                                        {{ in_array($item->id, $selectedDocs) ? 'selected' : '' }}
                                        style="padding:0.5rem;border:1px solid black; border-radius: 5px;margin-bottom:0.2rem">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div id="require_doc_hidden_inputs"></div>

                            @error('require_doc_ids')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Step Section --}}
                        <div class="mb-3">
                            @php
                                $selectedSteps = old('step_ids', json_decode($item2->step_ids ?? '[]', true));
                            @endphp
                            <label for="step_ids" class="form-label">Step Section</label>
                            <select id="step_ids"
                                class="multi-select form-select @error('step_ids') is-invalid @enderror" multiple
                                size="5" style="max-height: 150px; overflow-y: auto;" data-order-select
                                data-name="step_ids[]" data-hidden-container="step_hidden_inputs">
                                @foreach ($comRegStepSec as $item)
                                    <option value="{{ $item->id }}"
                                        {{ in_array($item->id, $selectedSteps) ? 'selected' : '' }}
                                        style="padding:0.5rem;border:1px solid black; border-radius: 5px;margin-bottom:0.2rem">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div id="step_hidden_inputs"></div>

                            @error('step_ids')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Why Section --}}
                        <div class="mb-3">
                            @php
                                $selectedWhys = old('why_ids', json_decode($item2->why_ids ?? '[]', true));
                            @endphp
                            <label for="why_ids" class="form-label">Why Section</label>
                            <select id="why_ids"
                                class="multi-select form-select @error('why_ids') is-invalid @enderror" multiple
                                size="5" style="max-height: 150px; overflow-y: auto;" data-order-select
                                data-name="why_ids[]" data-hidden-container="why_hidden_inputs">
                                @foreach ($comRegWhySec as $item)
                                    <option value="{{ $item->id }}"
                                        {{ in_array($item->id, $selectedWhys) ? 'selected' : '' }}
                                        style="padding:0.5rem;border:1px solid black; border-radius: 5px;margin-bottom:0.2rem">
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div id="why_hidden_inputs"></div>

                            @error('why_ids')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- FAQ Section --}}
                        <div class="mb-3">
                            @php
                                $selectedFaqs = old('faq_ids', json_decode($item2->faq_ids ?? '[]', true));
                            @endphp
                            <label for="faq_ids" class="form-label">FAQ</label>
                            <select id="faq_ids"
                                class="multi-select form-select @error('faq_ids') is-invalid @enderror" multiple
                                size="5" style="max-height: 150px; overflow-y: auto;" data-order-select
                                data-name="faq_ids[]" data-hidden-container="faq_hidden_inputs">
                                @foreach ($comRegFaqSec as $item)
                                    <option value="{{ $item->id }}"
                                        {{ in_array($item->id, $selectedFaqs) ? 'selected' : '' }}
                                        style="padding:0.5rem;border:1px solid black; border-radius: 5px;margin-bottom:0.2rem">
                                        {{ $item->ques }}
                                    </option>
                                @endforeach
                            </select>
                            <div id="faq_hidden_inputs"></div>

                            @error('faq_ids')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="is_active" class="form-label">Is Active </label>
                            <select name="is_active" id="is_active"
                                class="form-select @error('is_active') is-invalid @enderror">
                                <option value="1" {{ old('is_active', $item2->is_active) == '1' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="0" {{ old('is_active', $item2->is_active) == '0' ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-md">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
