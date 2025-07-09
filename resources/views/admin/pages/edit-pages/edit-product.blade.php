@extends('admin.layouts.app')

@section('title', 'dashboard | Edit Product')

@section('content') 

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Edit Product</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="productcategory_id" class="form-label">Product Category</label>
                            <select class="form-control" name="productcategory_id">
                                <option value="">-- Select Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->productcategory_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->productcategory }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="productimage" class="form-label">Product Image</label><br>
                                <img src="{{ asset($product->productimage) }}" width="60" height="60" class="mb-2">
                                <input type="file" class="form-control" name="productimage">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="heading" class="form-label">Product Heading</label>
                                <input type="text" class="form-control" name="heading" value="{{ $product->heading }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Botanical Name</label>
                                <input type="text" class="form-control" name="botanicalname" value="{{ $product->botanicalname }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Origin</label>
                                <input type="text" class="form-control" name="origin" value="{{ $product->origin }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-8">
                             <div class="mb-3">
                                <label for="color" class="form-label">Color</label>
                                <input type="text" class="form-control" name="color" value="{{ $product->color }}">
                             </div>
                        </div>
                    </div>

                    <!-- Quality -->
                    <div class="row mt-4">
                        <label class="form-label">Quality</label>
                        <div id="quality-wrapper" class="row g-2">
                            @foreach($product->quality ?? [] as $value)
                                <div class="col-md-10 mb-2">
                                    <input type="text" name="quality[]" class="form-control" value="{{ $value }}">
                                </div>
                            @endforeach
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success w-100" onclick="addInput('quality')">+</button>
                            </div>
                        </div>
                    </div>

                    <!-- Purity -->
                    <div class="row mt-4">
                        <label class="form-label">Purity</label>
                        <div id="purity-wrapper" class="row g-2">
                            @foreach($product->purity ?? [] as $value)
                                <div class="col-md-10 mb-2">
                                    <input type="text" name="purity[]" class="form-control" value="{{ $value }}">
                                </div>
                            @endforeach
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success w-100" onclick="addInput('purity')">+</button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Harvest Season</label>
                                <input type="text" class="form-control" name="harvestseason" value="{{ $product->harvestseason }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Shelf Life</label>
                                <input type="text" class="form-control" name="shelflife" value="{{ $product->shelflife }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Packaging Options</label>
                                <input type="text" class="form-control" name="packagingoption" value="{{ $product->packagingoption }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Minimum Order Quantity</label>
                                <input type="text" class="form-control" name="minimumorder" value="{{ $product->minimumorder }}">
                            </div>
                        </div>
                    </div>

                    <!-- Container Stuffing -->
                    <div class="row mt-4">
                        <label class="form-label">Container Stuffing</label>
                        <div id="container-wrapper" class="row g-2">
                            @foreach($product->containerstuffing ?? [] as $value)
                                <div class="col-md-10 mb-2">
                                    <input type="text" name="containerstuffing[]" class="form-control" value="{{ $value }}">
                                </div>
                            @endforeach
                            <div class="col-md-2">
                                <button type="button" class="btn btn-success w-100" onclick="addInput('container')">+</button>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <label class="form-label">Production Capacity</label>
                            <input type="text" class="form-control" name="producationcapacity" value="{{ $product->producationcapacity }}">
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <label class="form-label">Product Description</label>
                            <textarea name="description" id="description" class="form-control" rows="5">{{ $product->description }}</textarea>
                        </div>
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

@section('scripts')

<script src="{{ URL::asset('assets/admin/libs/eva-icons/eva.min.js') }}"></script>
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

<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script>
@endsection
