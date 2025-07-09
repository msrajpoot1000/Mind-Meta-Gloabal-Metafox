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
                    <form action="{{ route('admin-blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                       

                        <div class="row">
                            {{-- File Input --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="blog_image" class="form-label">Blog Image</label>
                                    <input type="file" class="form-control @error('blog_image') is-invalid @enderror"
                                           name="blog_image" id="photo1" accept="image/*">
                                    @error('blog_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        
                            {{-- Image Preview --}}
                            <div class="col-md-6 d-flex align-items-center justify-content-center">
                                <img id="image_preview1"
                                     src="{{ asset($blog->blog_image) }}"
                                     alt="Selected Image"
                                     style="max-width: 100%; max-width: 5rem; border: 1px solid #ccc; padding: 5px;">
                            </div>
                        </div>
                        

                        {{-- Uncomment if needed --}}
                        {{-- <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="heading" class="form-label">Blog Heading</label>
                                    <input type="text" class="form-control @error('heading') is-invalid @enderror" name="heading" id="heading" value="{{ old('heading') }}">
                                    @error('heading')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div> --}}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Blog Title <span
                                            class="astrick">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" id="title" required
                                        value="{{ old('title', $blog->title ?? '') }}">

                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="blog_date" class="form-label">Blog Date <span
                                            class="astrick">*</span></label>
                                    <input type="date" class="form-control @error('blog_date') is-invalid @enderror"
                                        name="blog_date" id="blog_date" required
                                        value="{{ old('blog_date', $blog->blog_date ?? '') }}">
                                    @error('blog_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label for="description" class="form-label">Blog Description <span
                                        class="astrick">*</span></label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                    rows="5" required placeholder="Write blog description...">{{ old('description', $blog->description ?? '') }}</textarea>
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
