@extends('admin.layouts.app')

@section('title', 'dashboard | Add Product')

@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Edit {{$pageName}}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin-content-pages.update', $contentPage->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Page -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="type" class="form-label">Page <span class="astrick">*</span></label>
                                    <input type="text" class="form-control @error('type') is-invalid @enderror"
                                        name="type" id="type" required
                                        value="{{ old('type', $contentPage->type ?? '') }}" readonly>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <!-- Heading -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="heading" class="form-label">Page Heading <span
                                            class="astrick">*</span></label>
                                    <input type="text" class="form-control @error('heading') is-invalid @enderror"
                                        name="heading" id="heading" required
                                        value="{{ old('heading', $contentPage->heading ?? '') }}">
                                    @error('heading')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label for="description" class="form-label">Testimonial Description <span
                                        class="astrick">*</span></label>
                                <div class="editor-wrapper">
                                    <textarea name="description" id="description1" class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Write testimonial...">{{ old('description', $contentPage->description) }}</textarea>
                                </div>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
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


@section('scripts')
    <script src="{{ URL::asset('assets/admin/libs/eva-icons/eva.min.js') }}"></script>

    <!-- CKEditor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>

    <!-- Initialize CKEditor 5 -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            ClassicEditor
                .create(document.querySelector('#description'))
                .catch(error => {
                    console.error(error);
                });
        });
    </script>

    <script>
        function addInput(type) {
            let wrapperId = type + "-wrapper";
            let wrapper = document.getElementById(wrapperId);

            let row = document.createElement('div');
            row.className = "row g-2 mt-2";
            row.innerHTML = `
            <div class="col-md-10">
                <input type="text" name="${type == 'container' ? 'containerstuffing[]' : type + '[]'}" class="form-control" placeholder="Enter ${type}">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger w-100" onclick="this.closest('.row').remove()">−</button>
            </div>
        `;
            wrapper.appendChild(row);
        }
    </script>





@endsection
