@extends('admin.layouts.app')

@section('title', 'dashboard | Add Product')

@section('content') 


    <div class="row mt-5">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">All product Data</h4> 
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                
                                <tr>
                                    <th>SN.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                   @foreach ($contacts as $contact)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->phone }}</td>
                                        <td>{{ $contact->subject }}</td>
                                        <td>{{ Str::limit($contact->message, 100) }}</td>
                                        <td>{{ $contact->created_at->format('d-m-Y') }}</td>
                                        
                
                                        <td class="d-flex flex-column row-gap-2">
                                            
                                            <form action="{{ route('admin-contact.destroy', $contact->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm px-4" onclick="return confirm('Are you sure you want to delete this project ?')">Delete</button>
                                            </form>
                                        </td>       
                                    </tr>
                                  @endforeach    
                            </tbody>
                           
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
<script src="{{ URL::asset('assets/admin/libs/eva-icons/eva.min.js') }}"></script>





@endsection