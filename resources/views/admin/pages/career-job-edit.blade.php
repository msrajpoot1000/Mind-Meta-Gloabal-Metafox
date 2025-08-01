@extends('admin.layouts.app')

@section('title', 'Dashboard | Edit Item')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Edit Item</h4>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">

                    <form action="{{ route('admin-career-job.update', $item2->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label>Career Job <span class="text-danger">*</span></label>
                                    <select name="ref_id" class="form-control" required>
                                        <option value="">-- Select --</option>
                                        @foreach ($items1 as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('ref_id', $item2->ref_id ?? '') == $item->id ? 'selected' : '' }}>
                                                {{ $item->job_type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="job_name" class="form-label">Job Name <span class="text-danger">*</span></label>
                            <input type="text" name="job_name" id="job_name"
                                class="form-control @error('job_name') is-invalid @enderror"
                                value="{{ old('job_name', $item2->job_name ?? '') }}">
                            @error('job_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description1" class="form-label">Job Description </label>
                            <textarea name="job_description" id="description1" class="form-control @error('job_description') is-invalid @enderror"
                                rows="4">{{ old('job_description', $item2->job_description ?? '') }}</textarea>
                            @error('job_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="is_active" class="form-label">Is Active </label>
                            <select name="is_active" id="is_active"
                                class="form-select @error('is_active') is-invalid @enderror">
                                <option value="1" {{ old('is_active', $item2->is_active) == '1' ? 'selected' : '' }}>
                                    Active</option>
                                <option value="0" {{ old('is_active', $item2->is_active) == '0' ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                            @error('is_active')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary w-md">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
