@extends('layouts.master')
@section('title')
    Product
@endsection
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <?php
        use Illuminate\Support\Facades\Config;
    ?>
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="title breadcrumbSpacing">
            <div class="sub-title">
                <h3 class="me-auto">
                Product
                </h3>
                <a href="{{ url('admin/category') }}">Product </a>
                <span><i class="fa-solid fa-circle fa-xs"></i></span>
                @if (empty($product))
                    <a>Add</a>
                @else
                    <a>Edit</a>
                @endif
            </div>
        </div>
        <?php
           $MAIN_URL = Config::get('constants.MAIN_URL');
        ?>
        @if (empty($product))
            <form action="{{ route('products.store') }}" id="formAccountSettings" method="POST"
                enctype="multipart/form-data">
            @else
                <form action="{{ route('products.update', $product->id) }}" id="formAccountSettings"
                    method="POST" enctype="multipart/form-data">
                    @method('PUT')
        @endif
        @csrf
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card-body bg-white p-1 rounded">
                        <br>
                        <h5 class="card-header mb-3 comman_cm_title">Product Image</h5>
                        <div class="gap-4" style="text-align: -webkit-center;">
                            <div class="uploader-img ">
                                @if (isset($product->product_image) && $product->product_image != '')
                                    <img id="uploadedAvatar"
                                        src="{{ url($MAIN_URL . 'product/' . $product->product_image) }}">
                                @else
                                    <img id="uploadedAvatar"
                                        src="{{ url($MAIN_URL . 'admin/newcustom/assets/img/avatars/17.png') }}">
                                @endif
                            </div>
                            <div class="button-wrapper">
                                <label for="upload" class="btn upload_btn" tabindex="0">
                                    <span class="d-none d-sm-block">Browse</span>
                                    <i class="ti ti-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" name="product_image" class="account-file-input"
                                        onchange="loadFile(event)" hidden accept="image/png, image/jpeg" />
                                </label>
                                <div class="text-muted">Upload photo size 256px*256px<br>
                                    *.PNG, *.JPG & *.JPEG File
                                </div>
                            </div>
                        </div>
                    </div><br>
                    <div class="card-body bg-white p-2 rounded mt-2">
                        <h5 class="card-header mb-3 comman_cm_title">Status</h5>
                        <div class="d-flex align-items-center gap-4">
                            <!-- Active Radio Button -->
                            <div class="form-check">
                                <input type="radio" name="status" id="status1" value="Active" class="form-check-input"
                                    {{ old('status', isset($product->status) && $product->status == 'Active' ? 'checked' : 'checked') }}>
                                <label class="form-check-label" for="status1">Active</label>
                            </div>

                            <!-- Inactive Radio Button -->
                            <div class="form-check">
                                <input type="radio" name="status" id="status2" value="InActive"
                                    class="form-check-input"
                                    {{ old('status', isset($product->status) && $product->status == 'InActive' ? 'checked' : '') }}>
                                <label class="form-check-label" for="status2">Inactive</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body paddtb">
                            <br>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="productname" class="form-label titletext">Product Name</label>
                                    <span class="required-color">*</span>
                                    <input class="form-control" type="text" id="productname" name="product_name"
                                        value="{{ old('product_name', isset($product->title) ? $product->title : '') }}"
                                        placeholder="Product Name" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="productprice" class="form-label titletext">Product Price</label>
                                    <span class="required-color">*</span>
                                    <input class="form-control" type="text" id="productprice" name="product_price"
                                        value="{{ old('product_price', isset($product->price) ? $product->price : '') }}"
                                        placeholder="Product Price" />
                                                                    </div>
                                <div class="mb-3 col-md-12">
                                    <label for="product_desc" class="form-label titletext">Product Description</label>
                                    <div class="card-body p-0">
                                        <textarea class="form-control" name="product_desc" id="product_desc" cols="70" rows="10"
                                            placeholder="Type Your Text here...">{{ old('product_desc', isset($product->description) ? $product->description : '') }}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="categories">Categories</label>
                                    <select name="categories[]" class="form-control" id="categories" multiple required>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if(isset($product) && !empty($product) && $product->categories->pluck('id')->contains($category->id))
                                                    selected
                                                @endif
                                            >{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 justify-content-end d-flex mt-5">
                        <button type="submit" class="btn me-2 btnSave">Save</button>
                        <a type="button" href="{{ route('products.index') }}" class="btn btnCancel">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- / Content -->
@endsection
@section('page-scripts')
    <!-- js-editer -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        function ValidateAlpha(evt) {
            var keyCode = (evt.which) ? evt.which : evt.keyCode
            if ((keyCode < 65 || keyCode > 90) && (keyCode < 97 || keyCode > 123) && keyCode != 32)
                return false;
            return true;
        }

        var loadFile = function(event) {
            var category_image_perview = document.getElementById('uploadedAvatar');
            category_image_perview.src = URL.createObjectURL(event.target.files[0]);
            category_image_perview.onload = function() {
                URL.revokeObjectURL(category_image_perview.src) // free memory
            }
        };

        $(document).ready(function() {
            $('#categories').select2({
                placeholder: "Select categories",
                allowClear: true
            });
        });
    </script>
@endsection
