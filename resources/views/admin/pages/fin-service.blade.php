@extends('admin.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst("Fin Service"))

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-2 d-flex justify-content-end fw-bold">
    <button id="toggleButton" class="btn btn-sm btn-success px-4 fs-5">Create {{ ucfirst("Fin Service") }}</button>
</div>

<div id="create-form-section">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Add {{ ucfirst("Fin Service") }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin-fin-service.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
    <label for="name" class="form-label">Name <span class="astrick">*</span></label>
    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label for="is_active" class="form-label">Is Active</label>
    <select name="is_active" id="is_active" class="form-select @error('is_active') is-invalid @enderror">
        <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
    </select>
    @error('is_active')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">All {{ ucfirst("Fin Service") }}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>SN.</th>
                                <th>Name</th>
<th>Is Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                                <tr>
                                    <td class="v-center">{{ $loop->iteration }}</td>
                                    <td class="v-center">{{ $item->name ?? 'N/A' }}</td>
<td class="v-center">
    @if ($item->is_active == 1)
        <span class="badge bg-success">Active</span>
    @elseif ($item->is_active == 0)
        <span class="badge bg-danger">Inactive</span>
    @else
        <span class="badge bg-secondary">N/A</span>
    @endif
</td>
                                    <td class="v-center">
                                        <a href="{{ route('admin-fin-service.edit', $item->id) }}" class="btn btn-sm btn-success px-4 m-1">Edit</a>
                                        <form action="{{ route('admin-fin-service.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm px-4 m-1" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%" class="text-center text-muted">No Data available.</td>
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