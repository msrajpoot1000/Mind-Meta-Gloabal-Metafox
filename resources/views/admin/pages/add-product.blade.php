@extends('admin.layouts.app')

@section('title', 'dashboard | Add Product')

@section('content') 

 <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Add Product</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="productcategory_id" class="form-label">Product Category</label>
                                  <select class="form-control" name="productcategory_id" id="productcategory_id">
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->productcategory }}</option>
                                    @endforeach
                                </select>
                            </div>
                       </div>
                        
                        
                        <div class="row">
                            <div class="col-md-6">
                                 <div class="mb-3">
                                    <label for="productimage" class="form-label">Product Image</label>
                                    <input type="file" class="form-control" value="" name="productimage">
                                 </div>
                            </div>
                            
                            <div class="col-md-6">
                                 <div class="mb-3">
                                    <label for="heading" class="form-label">Product Heading</label>
                                    <input type="text" class="form-control" value="" name="heading">
                                 </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                 <div class="mb-3">
                                    <label for="botanicalname" class="form-label">Botanical Name</label>
                                    <input type="text" class="form-control" value="" name="botanicalname">
                                 </div>
                            </div>
                            
                            <div class="col-md-6">
                                 <div class="mb-3">
                                    <label for="origin" class="form-label">Origin</label>
                                    <input type="text" class="form-control" value="" name="origin">
                                 </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-8">
                                 <div class="mb-3">
                                    <label for="color" class="form-label">Color</label>
                                    <input type="text" class="form-control" value="" name="color">
                                 </div>
                            </div>
                        </div>
                        
                         <!-- Quality (Multiple) -->
                            <div class="row mt-4">
                                <label class="form-label">Quality</label>
                                <div id="quality-wrapper" class="row g-2">
                                    <div class="col-md-10">
                                        <input type="text" name="quality[]" class="form-control" placeholder="Enter quality">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-success w-100" onclick="addInput('quality')">+</button>
                                    </div>
                                </div>
                            </div>
                        
                            <!-- Purity (Multiple) -->
                            <div class="row mt-4">
                                <label class="form-label">Purity</label>
                                <div id="purity-wrapper" class="row g-2">
                                    <div class="col-md-10">
                                        <input type="text" name="purity[]" class="form-control" placeholder="Enter purity">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-success w-100" onclick="addInput('purity')">+</button>
                                    </div>
                                </div>
                            </div>
                        
                         <div class="row">
                            <div class="col-md-6">
                                 <div class="mb-3">
                                    <label for="harvestseason" class="form-label">Harvest Season</label>
                                    <input type="text" class="form-control" value="" name="harvestseason">
                                 </div>
                            </div>
                            
                            <div class="col-md-6">
                                 <div class="mb-3">
                                    <label for="shelflife" class="form-label">Shelf Life</label>
                                    <input type="text" class="form-control" value="" name="shelflife">
                                 </div>
                            </div>
                        </div>
                        
                         <div class="row">
                            <div class="col-md-6">
                                 <div class="mb-3">
                                    <label for="packagingoption" class="form-label">Packaging Options</label>
                                    <input type="text" class="form-control" value="" name="packagingoption">
                                 </div>
                            </div>
                            
                            <div class="col-md-6">
                                 <div class="mb-3">
                                    <label for="minimumorder" class="form-label">Minimum Order Quantity (MOQ)</label>
                                    <input type="text" class="form-control" value="" name="minimumorder">
                                 </div>
                            </div>
                        </div>
                        
                         <div class="row">
                            <div class="row mt-4">
                                 <label class="form-label">Container Stuffing</label>
                                <div id="container-wrapper" class="row g-2">
                                    <div class="col-md-10">
                                        <input type="text" name="containerstuffing[]" class="form-control" placeholder="Enter stuffing">
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" class="btn btn-success w-100" onclick="addInput('container')">+</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                 <div class="mb-3">
                                    <label for="producationcapacity" class="form-label">Production Capacity</label>
                                    <input type="text" class="form-control" value="" name="producationcapacity">
                                 </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <label for="description" class="form-label">Product Description</label>
                                <textarea name="description" id="description" class="form-control" rows="5" placeholder="Write product description..."></textarea>
                            </div>
                        </div>
                                                
                        <div>
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
        <!-- end col -->
    </div>
    <!-- end row -->



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
                                    <th>Project Image</th>
                                    <th>Product Category</th>
                                    <th>Project Heading</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                   @foreach ($products as $product)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        
                
                                        <td>
                                            <img src="{{ asset($product->productimage) }}" width="60" height="60" class="rounded-circle" alt="product Image">
                                        </td>
                                        
                                        <td>{{ $product->category->productcategory ?? 'N/A' }}</td>

                                        
                                        <td>{{ $product->heading }}</td>
                                        
                
                                        <td class="d-flex flex-column row-gap-2">
                                            
                                            <a href="{{ route('product.edit', $product->id) }}" target="_blank" class="btn btn-sm btn-success px-4">Edit</a>
                                            
                                            <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline-block;">
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

<!-- CKEditor Script -->
  <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            CKEDITOR.replace('editor1');
        });
    </script>
    
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

<!-- CKEditor CDN -->
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

<!-- Initialize CKEditor -->
<script>
    CKEDITOR.replace('description');
</script>



@endsection