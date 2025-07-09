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
                    <form action="{{ route('admin-sub-industries.update', $subIndustry->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <!-- Client Name -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name <span class="astrick">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        name="name" id="name" required
                                        value="{{ old('name', $subIndustry->name ?? '') }}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <!-- Client Name -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label>Industry</label>
                                    <select name="industry_id" class="form-control" required>
                                        @foreach ($industries as $industry)
                                            <option value="{{ $industry->id }}"
                                                {{ $subIndustry->industry_id == $industry->id ? 'selected' : '' }}>
                                                {{ $industry->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
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
                                            {{ old('status', $subIndustry->status) == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0"
                                            {{ old('status', $subIndustry->status) == 0 ? 'selected' : '' }}>Inactive
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
