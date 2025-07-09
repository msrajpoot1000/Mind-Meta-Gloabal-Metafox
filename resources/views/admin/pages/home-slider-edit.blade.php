@extends('admin.layouts.app')

@section('title', 'dashboard | Add Product')

@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add Blog</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin-home-slider.update', $homeSliders->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <!-- Client Name -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title <span class="astrick">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" id="title" required
                                        value="{{ old('title', $homeSliders->title ?? '') }}">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <!-- Testimonial Photo -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="image" class="form-label">image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        name="image" id="photo1" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Image Preview --}}
                            <div class="col-md-6 d-flex align-items-center justify-content-center">
                                <img id="image_preview1" src="{{ asset($homeSliders->image) }}" alt="Selected Image"
                                    style="max-width: 100%; max-width: 5rem; border: 1px solid #ccc; padding: 5px;">
                            </div>
                        </div>

                        <!-- Testimonial Description -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label for="description" class="form-label"> Description <span
                                        class="astrick">*</span></label>
                                <div class="editor-wrapper">
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Write testimonial...">{{ old('description', $homeSliders->description) }}</textarea>
                                </div>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        {{-- rating  && status --}}
                        <div class="row">
                            <!-- Status -->
                            <div class="col-md-12">
                                <div class="mb-3">

                                    <label for="status" class="form-label">Status</label>
                                    <br>
                                    <select name="status"
                                        class="form-select form-control @error('status') is-invalid @enderror">
                                        <option value="1"
                                            {{ old('status', $homeSliders->status) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0"
                                            {{ old('status', $homeSliders->status) == 0 ? 'selected' : '' }}>Inactive
                                        </option>
                                    </select>

                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
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
