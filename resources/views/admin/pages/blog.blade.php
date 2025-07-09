@extends('admin.layouts.app')

@section('title', 'dashboard | Add Product')

@section('content')


    <div class="mb-2 d-flex justify-content-end fw-bold">
        <button id="toggleButton" class="btn btn-sm btn-success px-4 fs-5">Create Blog</button>
    </div>


    <div id="create-form-section">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add Blog</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin-blog.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf


                        <div class="row">
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

                            <div class="col-md-6 d-flex align-items-center justify-content-center">
                                <img id="image_preview1" src="#" alt="Selected Image"
                                    style="max-width: 100%; max-width: 5rem; display: none; border: 1px solid #ccc; padding: 5px;">
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
                                        name="title" id="title" required value="{{ old('title') }}">
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="blog_date" class="form-label">Blog Date (mm/dd/yyyy) <span
                                            class="astrick">*</span></label>
                                    <input type="date" class="form-control @error('blog_date') is-invalid @enderror"
                                        name="blog_date" id="blog_date" required
                                        value="{{ old('blog_date', isset($blog->blog_date) ? $blog->blog_date : date('Y-m-d')) }}">

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
                                <div class="editor-wrapper">
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" required
                                        placeholder="Write blog description...">{{ old('description') }}</textarea>
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
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Blogs</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th> Title
                                    <th> Image</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($blogs as $blog)
                                    <tr>
                                        <th class="v-center" scope="row">{{ $loop->iteration }}</th>

                                        <td class="v-center">{{ $blog->title }}</td>
                                        <td class="v-center">
                                            <img src="{{ asset($blog->blog_image) }}" width="60" height="60"
                                                class="rounded-circle" alt="no image">
                                        </td class="v-center">

                                        <td class="v-center">{{ $blog->blog_date ?? 'N/A' }}</td>
                                        <td
                                            style="vertical-align: middle;white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
                                            {{ strip_tags($blog->description) }}
                                        </td>



                                        <td class="v-center" class="d-flex flex-wrap row-gap-2">

                                            <a href="{{ route('admin-blog.edit', $blog->id) }}"
                                                class="btn btn-sm btn-success px-4 m-1">Edit</a>

                                            <form action="{{ route('admin-blog.destroy', $blog->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm px-4 m-1"
                                                    onclick="return confirm('Are you sure you want to delete this project ?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">No Data available.</td>
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


@section('scripts')
    <script src="{{ URL::asset('assets/admin/libs/eva-icons/eva.min.js') }}"></script>

    


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
