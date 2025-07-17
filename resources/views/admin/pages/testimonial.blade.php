@extends('admin.layouts.app')

@section('title', 'dashboard | Add Product')

@section('content')


    <div class="mb-2 d-flex justify-content-end fw-bold">
        <button id="toggleButton" class="btn btn-sm btn-success px-4 fs-5">Create Testimonial</button>
    </div>


    <div id="create-form-section">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add Testimonials</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin-testimonial.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf


                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="mb-3">
                                    <label for="photo1" class="form-label">Client Photo</label>
                                    <input type="file"
                                        class="form-control preview-image-input @error('photo') is-invalid @enderror"
                                        data-preview-id="photo_preview1" name="photo1" id="photo1" accept="image/*">
                                    @error('photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mt-3 d-flex align-items-center justify-content-center">
                                <img id="photo_preview1" src="#" alt="Selected Image"
                                    style="max-width: 5rem; display: none; border: 1px solid #ccc; padding: 5px;">
                            </div>
                        </div>

                        <div class="row">
                            <!-- Client Name -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="client_name" class="form-label">Client Name <span
                                            class="astrick">*</span></label>
                                    <input type="text" class="form-control @error('client_name') is-invalid @enderror"
                                        name="client_name" id="client_name" required value="{{ old('client_name') }}">
                                    @error('client_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- <!-- Client Position -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="client_position" class="form-label">Client Position<span class="astrick"> *
                                        </span></label>
                                    <input type="text"
                                        class="form-control @error('client_position') is-invalid @enderror"
                                        name="client_position" id="client_position" value="{{ old('client_position') }}"
                                        required>
                                    @error('client_position')  
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> --}}
                        </div>

                        {{-- rating and status  --}}
                        <div class="row">
                            <!-- Rating -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="rating" class="form-label">Rating (1-5)</label>
                                    <input type="number" min="1" max="5"
                                        class="form-control @error('rating') is-invalid @enderror" name="rating"
                                        id="rating" value="{{ old('rating', 5) }}">
                                    @error('rating')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <div class="mb-3">

                                    <label for="status" class="form-label">Status</label>
                                    <br>
                                    <select name="status"
                                        class="form-select form-control @error('status') is-invalid @enderror">
                                        <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive
                                        </option>

                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial Description -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label for="description" class="form-label">Testimonial Description <span
                                        class="astrick">*</span></label>
                                <div class="editor-wrapper">
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Write testimonial...">{{ old('description') }}</textarea>
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
                    <h4 class="card-title">All Testimonials</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th> Client Name
                                        {{-- <th> Client Position</th> --}}
                                    <th>Photo</th>
                                    <th>Description</th>
                                    <th>rating</th>
                                    <th>status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($testimonials as $testimonial)
                                    <tr>
                                        <th class="v-center" scope="row">{{ $loop->iteration }}</th>
                                        <td class="v-center">{{ $testimonial->client_name ?? 'N/A' }}</td>
                                        {{-- <td class="v-center">{{ $testimonial->client_position ?? 'N/A' }}</td> --}}
                                        <td class="v-center">
                                            <img src="{{ asset($testimonial->photo1) }}" width="60" height="60"
                                                class="rounded-circle" alt="no image">
                                        </td class="v-center">
                                        <td
                                            style="vertical-align: middle;white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
                                            {{ strip_tags($testimonial->description) }}
                                        </td>
                                        <td class="v-center">{{ $testimonial->rating ?? 'N/A' }}</td>
                                        <td class="v-center">
                                            @if ($testimonial->status == 1)
                                                <span class="badge bg-success">Active</span>
                                            @elseif ($testimonial->status == 0)
                                                <span class="badge bg-danger">Inactive</span>
                                            @else
                                                <span class="badge bg-secondary">N/A</span>
                                            @endif
                                        </td>



                                        <td class="v-center" class="d-flex flex-wrap row-gap-2">

                                            <a href="{{ route('admin-testimonial.edit', $testimonial->id) }}"
                                                class="btn btn-sm btn-success px-4 m-1">Edit</a>

                                            <form action="{{ route('admin-testimonial.destroy', $testimonial->id) }}"
                                                method="POST" style="display:inline-block;">
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
