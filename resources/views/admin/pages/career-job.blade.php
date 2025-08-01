@extends('admin.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst('career-job'))

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

    <div class="mb-2 text-end">
        <button id="toggleButton" class="btn btn-sm btn-success">Create {{ ucfirst('Career Job') }}</button>
    </div>

    <div id="create-form-section">
        <div class="card">
            <div class="card-header">
                <h4>Add {{ ucfirst('Career Job') }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin-career-job.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label>Career <span class="text-danger">*</span></label>
                                <select name="ref_id" class="form-control" required>
                                    <option value="">-- Select --</option>
                                    @foreach ($items1 as $item)
                                        <option value="{{ $item->id }}">{{ $item->job_type }}</option>
                                    @endforeach
                                </select>
                                @error('ref_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="job_name" class="form-label">Job Name <span class="text-danger">*</span></label>
                        <input type="text" name="job_name" id="job_name"
                            class="form-control @error('job_name') is-invalid @enderror" value="{{ old('job_name') }}">
                        @error('job_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description1" class="form-label">Job Description </label>
                        <textarea name="job_description" id="description1" class="form-control @error('job_description') is-invalid @enderror"
                            rows="4">{{ old('job_description') }}</textarea>
                        @error('job_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="is_active" class="form-label">Is Active </label>
                        <select name="is_active" id="is_active"
                            class="form-select @error('is_active') is-invalid @enderror">
                            <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('is_active')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="mt-4 card">
        <div class="card-header">
            <h4>All {{ ucfirst('Career Job') }}</h4>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>SN.</th>
                        <th>Career</th>
                        <th>Job Name</th>
                        <th>Job Description</th>
                        <th>Is Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items2 as $item)
                        <tr>
                            <td class="v-center">{{ $loop->iteration }}</td>
                            <td class="v-center">{{ $item->career->job_type ?? 'N/A' }}</td>
                            <td class="v-center">{{ $item->job_name ?? 'N/A' }}</td>
                            <td class="v-center text-truncate" style="max-width:200px;">
                                {{ strip_tags($item->job_description) }}</td>
                            <td class="v-center">
                                @if ($item->is_active == 1)
                                    <span class="badge bg-success">Active</span>
                                @elseif($item->is_active == 0)
                                    <span class="badge bg-danger">Inactive</span>
                                @else
                                    <span class="badge bg-secondary">N/A</span>
                                @endif
                            </td>
                            <td class="v-center">
                                <a href="{{ route('admin-career-job.edit', $item->id) }}"
                                    class="btn btn-sm btn-success">Edit</a>
                                <form action="{{ route('admin-career-job.destroy', $item->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
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
@endsection
