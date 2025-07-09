@extends('admin.layouts.app')

@section('title', 'dashboard | Add Product')

@section('content')


    <div class="mb-2 d-flex justify-content-end fw-bold">
        <button id="toggleButton" class="btn btn-sm btn-success px-4 fs-5">Create FAQ</button>
    </div>


    <div id="create-form-section">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add Faq</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin-faq.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="row">
                                <!-- Client Name -->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="question" class="form-label">Question <span
                                                class="astrick">*</span></label>
                                        <input type="text" class="form-control @error('question') is-invalid @enderror"
                                            name="question" id="question" required value="{{ old('question') }}">
                                        @error('question')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>




                        </div>

                        <!-- Answer -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label for="answer" class="form-label">Answer<span class="astrick">*</span></label>
                                <div class="editor-wrapper">
                                    <textarea name="answer" id="description" class="form-control @error('answer') is-invalid @enderror"
                                        placeholder="Write testimonial...">{{ old('answer') }}</textarea>
                                </div>
                                @error('answer')
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
                    <h4 class="card-title">All Faq</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th> Questions</th>
                                    <th> Answer</th>
                                    <th>status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($faqs as $faq)
                                    <tr>
                                        <th class="v-center" scope="row">{{ $loop->iteration }}</th>
                                        <td class="v-center">{{ strip_tags($faq->question) ?? 'N/A' }}</td>
                                        <td
                                            style="vertical-align: middle;white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
                                            {{ strip_tags($faq->answer) }}
                                        </td>
                                        <td class="v-center">
                                            @if ($faq->status == 1)
                                                <span class="badge bg-success">Active</span>
                                            @elseif ($faq->status == 0)
                                                <span class="badge bg-danger">Inactive</span>
                                            @else
                                                <span class="badge bg-secondary">N/A</span>
                                            @endif
                                        </td>

                                        <td class="v-center" class="d-flex flex-wrap row-gap-2">

                                            <a href="{{ route('admin-faq.edit', $faq->id) }}"
                                                class="btn btn-sm btn-success px-4 m-1">Edit</a>

                                            <form action="{{ route('admin-faq.destroy', $faq->id) }}" method="POST"
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
