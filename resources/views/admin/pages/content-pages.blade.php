@extends('admin.layouts.app')

@section('title', 'dashboard | Add Product')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All Pages</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th> Page</th>
                                    <th> Heading</th>
                                    <th>Description</th>

                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($contentPagesContents as $contentPagesContent)
                                    <tr>
                                        <th class="v-center" scope="row">{{ $loop->iteration }}</th>
                                        <td class="v-center">{{ $contentPagesContent->type ?? 'N/A' }}</td>
                                        <td class="v-center">{{ $contentPagesContent->heading ?? 'N/A' }}</td>

                                        </td class="v-center">
                                        <td
                                            style="vertical-align: middle;white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 200px;">
                                            {{ strip_tags($contentPagesContent->description) }}
                                        </td>

                                        <td class="v-center" class="d-flex flex-wrap row-gap-2">

                                            <a href="{{ route('admin-content-pages.edit', $contentPagesContent->id) }}"
                                                class="btn btn-sm btn-success px-4 m-1">Edit</a>

                                            {{-- <form action="{{ route('admin-testimonial.destroy', $privacyPolicy->id) }}"
                                                method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm px-4 m-1"
                                                    onclick="return confirm('Are you sure you want to delete this project ?')">Delete</button>
                                            </form> --}}
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
