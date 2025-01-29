@extends('layouts.master')
@section('title')
    Categories
@endsection
@section('content')
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
                    Categories
                </h3>
                <a href="{{ url('/category') }}">Categories </a>
                <span><i class="fa-solid fa-circle fa-xs"></i></span>
                @if (empty($category))
                    <a>Add</a>
                @else
                    <a>Edit</a>
                @endif
            </div>
        </div>
        <?php
           $MAIN_URL = Config::get('constants.MAIN_URL');
        ?>
        @if (empty($category))
            <form action="{{ route('categories.store') }}" id="formAccountSettings" method="POST"
                enctype="multipart/form-data">
            @else
                <form action="{{ route('categories.update', $category->id) }}" id="formAccountSettings"
                    method="POST" enctype="multipart/form-data">
                    @method('PUT')
        @endif
        @csrf
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card-body bg-white p-1 rounded">
                        <br>
                        <h5 class="card-header mb-3 comman_cm_title">Category Image</h5>
                        <div class="gap-4" style="text-align: -webkit-center;">
                            <div class="uploader-img ">
                                @if (isset($category->category_image) && $category->category_image != '')
                                    <img id="uploadedAvatar"
                                        src="{{ url($MAIN_URL . 'categories/' . $category->category_image) }}">
                                @else
                                    <img id="uploadedAvatar"
                                        src="{{ url($MAIN_URL . 'admin/newcustom/assets/img/avatars/17.png') }}">
                                @endif
                            </div>
                            <div class="button-wrapper">
                                <label for="upload" class="btn upload_btn" tabindex="0">
                                    <span class="d-none d-sm-block">Browse</span>
                                    <i class="ti ti-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" name="category_image" class="account-file-input"
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
                                    {{ old('status', isset($category->status) && $category->status == 'Active' ? 'checked' : 'checked') }}>
                                <label class="form-check-label" for="status1">Active</label>
                            </div>

                            <!-- Inactive Radio Button -->
                            <div class="form-check">
                                <input type="radio" name="status" id="status2" value="InActive"
                                    class="form-check-input"
                                    {{ old('status', isset($category->status) && $category->status == 'InActive' ? 'checked' : '') }}>
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
                                    <label for="categoryname" class="form-label titletext">Category Name</label>
                                    <span class="required-color">*</span>
                                    <input class="form-control" type="text" id="categoryname" name="category_name"
                                        value="{{ old('category_name', isset($category->category_name) ? $category->category_name : '') }}"
                                        autofocus placeholder="Category Name" />
                                    <div class="text-muted">Add Category Name here</div>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="categoryname" class="form-label titletext">Category Description</label>
                                    <div class="card-body p-0">
                                        <textarea class="form-control" name="category_desc" id="category_desc" cols="70" rows="10"
                                            placeholder="Type Your Text here...">{{ old('category_desc', isset($category->category_desc) ? $category->category_desc : '') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2 justify-content-end d-flex mt-5">
                        <button type="submit" class="btn me-2 btnSave">Save</button>
                        <a type="button" href="{{ route('categories.index') }}" class="btn btnCancel">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- / Content -->
@endsection
@section('page-scripts')
    <!-- js-editer -->
    <script src="{{ asset('admin/newcustom/assets/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('admin/newcustom/assets/vendor/libs/quill/quill.js') }}"></script>
    <script src="{{ asset('admin/newcustom/assets/js/forms-editors.js') }}"></script>
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
    </script>
@endsection
