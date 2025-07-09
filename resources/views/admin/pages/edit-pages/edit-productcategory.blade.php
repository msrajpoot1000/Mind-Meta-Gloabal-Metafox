@extends('admin.layouts.app')

@section('title', 'dashboard | Edit Project Category')

@section('content') 

 <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Edit Product Category</h4>
                <a href="{{ route('website.admin.productcategory') }}" class="btn btn-secondary btn-sm">Back</a>
            </div>
            <div class="card-body">
                <form action="{{ route('productcategory.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="productcategory" class="form-label">Product Category</label>
                        <input type="text" class="form-control" name="productcategory" id="productcategory" value="{{ old('productcategory', $category->productcategory) }}">
                    </div>

                    <div class="mb-3">
                        <label for="productcategoryimage" class="form-label">Product Category Image</label>
                        <input type="file" class="form-control" name="productcategoryimage" id="productcategoryimage">
                        @if($category->productcategoryimage)
                            <img src="{{ asset($category->productcategoryimage) }}" alt="Image" width="100" class="mt-2">
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Update Category</button>
            </div>
        </div>
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