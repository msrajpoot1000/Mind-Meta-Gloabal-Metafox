@extends('admin.layouts.app')

@section('title', 'dashboard | Edit Industry Served')

@section('content') 

 <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-0">Industry Served</h4>
                        </div>
                    </div>
                    <div class="card-body">
            
                        <form action="{{ route('serve.update', $serve->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" placeholder="Add Industry serve name" id="name" name="name" value="{{ old('name', $serve->name) }}">
                                    </div>
                                </div>
                                
                                 <div class="mb-3">
                                        <label class="form-label d-block">Current Image</label>
                                        <img src="{{ asset($serve->image) }}"
                                             alt="{{ $serve->name }}"
                                             class="img-thumbnail mb-2"
                                             style="max-width: 150px; max-height: 120px;">
                                        <div class="mt-2">
                                            <label for="image" class="form-label">Change Image (optional)</label>
                                            <input type="file"
                                                   name="image"
                                                   id="image"
                                                   class="form-control">
                                            <small class="text-muted">Allowed: jpg, jpeg, png, webp, svg — max 2 MB.</small>
                                        </div>
                                    </div>
                            <div>
                                <button type="submit" class="btn btn-primary w-md">Submit</button>
                                <a href="{{ route('serve') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left-circle me-1"></i> Back
                                </a>
                            </div>
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
        </div>
        
@endsection


@section('scripts')
<script src="{{ URL::asset('assets/admin/libs/eva-icons/eva.min.js') }}"></script>

<!-- CKEditor Script -->
  <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            CKEDITOR.replace('editor1');
        });
    </script

@endsection