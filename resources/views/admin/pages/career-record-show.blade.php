@extends('admin.layouts.app')

@section('title', 'Dashboard | Add ' . ucfirst('career-job'))

@section('content')
    <div class="container mt-4">
        <h4>Career Record Details</h4>
        <div class="card mt-3">
            <div class="card-body">
                <p><strong>Name:</strong> {{ $record->name }}</p>
                <p><strong>Email:</strong> {{ $record->email }}</p>
                <p><strong>Phone:</strong> {{ $record->phone }}</p>
                <p><strong>Job Type:</strong> {{ $record->job_type }}</p>

                <p><strong>Resume:</strong>
                    @if ($record->resume_path)
                        <a href="{{ asset($record->resume_path) }}" target="_blank">View Resume</a>
                    @else
                        <span class="text-muted">Not uploaded</span>
                    @endif
                </p>
                <p><strong>Message:</strong>
                    {{ $record->message ?? 'empty' }}
                </p>

                <p><strong>Submitted At:</strong> {{ $record->created_at->format('d M Y, h:i A') }}</p>

                {{-- <a href="{{ route('admin-career-record.index') }}" class="btn btn-secondary mt-3">Back to List</a> --}}
            </div>
        </div>
    </div>
@endsection
