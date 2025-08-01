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



    <div class="mt-4 card">
        <div class="card-header">
            <h4>All {{ ucfirst('Career Job') }}</h4>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>SN.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Job Type</th>
                        <th>Resume</th>
                        <th>Message</th>
                        <th>Submitted At</th>
                        <th>Actions</th>
                        <th>Show Detail </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $record)
                        <tr>
                            <td class="v-center">{{ $loop->iteration }}</td>
                            <td class="v-center">{{ $record->name }}</td>
                            <td class="v-center">{{ $record->email }}</td>
                            <td class="v-center">{{ $record->phone }}</td>
                            <td class="v-center">{{ $record->job_type ?? 'N/A' }}</td>
                            <td class="v-center">
                                @if ($record->resume_path)
                                    <a href="{{ asset('upload/career-record/' . basename($record->resume_path)) }}"
                                        target="_blank">View</a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td class="v-center text-truncate" style="max-width:200px;">
                                {{ Str::limit(strip_tags($record->message), 100) }}
                            </td>
                            <td class="v-center">{{ $record->created_at->format('Y-m-d H:i') }}</td>
                            <td class="v-center">
                                <form action="{{ route('career-record.destroy', $record->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                            <td class="v-center">
                                <a href="{{ route('admin-career-record.show', $record->id) }}">Show Detail</a>
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
