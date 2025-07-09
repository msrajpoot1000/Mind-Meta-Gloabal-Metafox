@extends('admin.layouts.app')

@section('title', 'dashboard | Add Product')

@section('content')


    <div class="mb-2 d-flex justify-content-end fw-bold">
        <button id="toggleButton" class="btn btn-sm btn-success px-4 fs-5">Create Slide</button>
    </div>


    <div id="create-form-section">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add Slide</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin-home-slider.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf


                        <div class="row">
                            <!-- Client Name -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title <span
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
                            <!-- Testimonial Photo -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Slider Background Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        name="image" id="photo1" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Image Preview -->
                            <div class="col-md-6 d-flex align-items-center justify-content-center">
                                <img id="image_preview1" src="#" alt="Selected Image"
                                    style="max-width: 5rem; display: none; border: 1px solid #ccc; padding: 5px;">
                            </div>
                        </div>

                        

                        {{-- rating and status  --}}
                        <div class="row">
                          

                            <!-- Status -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    
                                    <label for="status" class="form-label">Status</label>
                                    <br>
                                    <select name="status" 
                                        class="form-select form-control @error('status') is-invalid @enderror">
                                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
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
                                <label for="description" class="form-label">Description <span
                                        class="astrick">*</span></label>
                                <div class="editor-wrapper">
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Write description...">{{ old('description') }}</textarea>
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
                    <h4 class="card-title">All Home Slider</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th> Title</th>
                                    <th>Image</th>
                                    <th>status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($homeSliders as $homeSlider)
                                    <tr>
                                        <th class="v-center" scope="row">{{ $loop->iteration }}</th>
                                        <td class="v-center">{{ $homeSlider->title ?? 'N/A' }}</td>
                                        <td class="v-center">
                                            <img src="{{ asset($homeSlider->image) }}" width="60" height="60"
                                                class="rounded-circle" alt="no image">
                                        </td class="v-center">
                                        <td
                                            style="vertical-align: middle;white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
                                            {{ strip_tags($homeSlider->description) }}
                                        </td>
                                        <td class="v-center">
                                            @if ($homeSlider->status == 1)
                                                <span class="badge bg-success">Active</span>
                                            @elseif ($homeSlider->status == 0)
                                                <span class="badge bg-danger">Inactive</span>
                                            @else
                                                <span class="badge bg-secondary">N/A</span>
                                            @endif
                                        </td>



                                        <td class="v-center" class="d-flex flex-wrap row-gap-2">

                                            <a href="{{ route('admin-home-slider.edit', $homeSlider->id) }}"
                                                class="btn btn-sm btn-success px-4 m-1">Edit</a>

                                            <form action="{{ route('admin-home-slider.destroy', $homeSlider->id) }}"
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


@section('scripts')




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
