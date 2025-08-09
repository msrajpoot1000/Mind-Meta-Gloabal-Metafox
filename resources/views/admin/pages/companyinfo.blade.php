@extends('admin.layouts.app')

@section('title', 'dashboard | company information')

@section('content')


    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Company Information</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form action="{{ route('edit.companyinfo') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="companyname" class="form-label">Company Name</label>
                            <input type="text" class="form-control @error('companyname') is-invalid @enderror"
                                name="companyname" placeholder="Enter Company Name"
                                value="{{ old('companyname', $companyinfos->companyname) }}">
                            @error('companyname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="client_name" class="form-label">Client Name</label>
                            <input type="text" class="form-control @error('client_name') is-invalid @enderror"
                                name="client_name" placeholder="Enter Client Name"
                                value="{{ old('client_name', $companyinfos->client_name) }}">
                            @error('client_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Company Title</label>
                            <textarea class="form-control @error('title') is-invalid @enderror" id="description1" name="title"
                                placeholder="Enter Company Title">{{ old('title', $companyinfos->title) }}</textarea>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Company Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description2" name="description"
                                placeholder="Enter Company Description">{{ old('description', $companyinfos->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="logo" class="form-label">Website Logo / Business Logo <span
                                            class="text-danger">*</span></label>
                                    <input type="file"
                                        class="form-control preview-image-input @error('logo') is-invalid @enderror"
                                        name="logo" id="logo" data-preview-id="photo_preview_logo" accept="image/*">
                                    @error('logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 d-flex align-items-center justify-content-center">
                                <img id="photo_preview_logo" src="{{ asset($companyinfos->logo) }}" alt="No Image"
                                    style="max-width: 5rem; border: 1px solid #ccc; padding: 5px;">
                                <input type="hidden" name="status_logo" id="status_logo"
                                    value="{{ $companyinfos->logo ? 1 : 0 }}">
                                <button type="button" id="statusPhotoBtn_logo" class="btn btn-danger btn-sm m-2">
                                    <i class="fas fa-trash"></i> Delete Image
                                </button>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="favicon" class="form-label">Company Favicon Icon (png/svg/ico) <span
                                            class="text-danger">*</span></label>
                                    <input type="file"
                                        class="form-control preview-image-input @error('favicon') is-invalid @enderror"
                                        name="favicon" id="favicon" data-preview-id="photo_preview_favicon"
                                        accept="image/*">
                                    @error('favicon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 d-flex align-items-center justify-content-center">
                                <img id="photo_preview_favicon" src="{{ asset($companyinfos->favicon) }}" alt="No Image"
                                    style="max-width: 5rem; border: 1px solid #ccc; padding: 5px;">
                                <input type="hidden" name="status_favicon" id="status_favicon"
                                    value="{{ $companyinfos->favicon ? 1 : 0 }}">
                                <button type="button" id="statusPhotoBtn_favicon" class="btn btn-danger btn-sm m-2">
                                    <i class="fas fa-trash"></i> Delete Image
                                </button>
                            </div>
                        </div>


                        {{-- tax guide link  --}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="tax_guide_link" class="form-label">Tax Guide Link</label>
                                    <input type="tax_guide_link"
                                        class="form-control @error('tax_guide_link') is-invalid @enderror"
                                        name="tax_guide_link" placeholder="Enter tax guide_link"
                                        value="{{ old('tax_guide_link', $companyinfos->tax_guide_link) }}" required>
                                    @error('tax_guide_link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="about_pdf" class="form-label">About PDF <span
                                            class="text-danger">*</span></label>
                                    <input type="file"
                                        class="form-control preview-image-input @error('about_pdf') is-invalid @enderror"
                                        name="about_pdf" id="about_pdf" data-preview-id="photo_preview_about_pdf">
                                    @error('about_pdf')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 d-flex align-items-center justify-content-center">

                                @if ($companyinfos->about_pdf)
                                    <a href="{{ url($companyinfos->about_pdf) }}" class="btn btn-primary btn-sm"
                                        download>
                                        <i class="fas fa-file-download"></i> Download PDF
                                    </a>

                                    <input type="hidden" name="status_about_pdf" id="status_about_pdf" value="1">
                                @else
                                    <span>No PDF Uploaded</span>
                                    <input type="hidden" name="status_about_pdf" id="status_about_pdf" value="0">
                                @endif
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Enter Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" placeholder="Enter Email"
                                        value="{{ old('email', $companyinfos->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone No.</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        name="phone" placeholder="Enter Phone No."
                                        value="{{ old('phone', $companyinfos->phone) }}" maxlength="20"
                                        oninput="this.value = this.value.replace(/[^0-9 +-]/g, '')">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone2" class="form-label">2 Phone No.</label>
                                    <input type="text" class="form-control @error('phone2') is-invalid @enderror"
                                        name="phone2" placeholder="Enter Phone No."
                                        value="{{ old('phone2', $companyinfos->phone2) }}" maxlength="20"
                                        oninput="this.value = this.value.replace(/[^0-9 +\-]/g, '')">

                                    @error('phone2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone3" class="form-label">3 Phone No.</label>
                                    <input type="text" class="form-control @error('phone3') is-invalid @enderror"
                                        name="phone3" placeholder="Enter Phone No."
                                        value="{{ old('phone3', $companyinfos->phone3) }}" maxlength="20"
                                        pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9 +\-]/g, '')">

                                    @error('phone3')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        name="address" placeholder="Enter address"
                                        value="{{ old('address', $companyinfos->address) }}">
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="address2" class="form-label">Address2</label>
                                    <input type="text" class="form-control @error('address2') is-invalid @enderror"
                                        name="address2" placeholder="Enter address2"
                                        value="{{ old('address2', $companyinfos->address2) }}">
                                    @error('address2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @foreach (['facebook', 'instagram', 'twitter', 'youtube', 'linkedin', 'pinterest'] as $social)
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="{{ $social }}"
                                            class="form-label">{{ ucfirst($social) }}</label>
                                        <input type="url" class="form-control @error($social) is-invalid @enderror"
                                            name="{{ $social }}" placeholder="Enter {{ ucfirst($social) }} link"
                                            value="{{ old($social, $companyinfos->$social) }}">
                                        @error($social)
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div>
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-secondary w-md">Back</a>
                        </div>
                    </form>

                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
        <!-- end col -->
    </div>
    <!-- end row -->

@endsection
