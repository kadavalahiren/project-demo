@extends('layouts.master')
@section('head')
    <!-- jquery -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> --}}
    <!-- CSS -->
    <link rel="stylesheet" href="{{ config('constants.BASE_URL_MEDIA') . '/css/custom.css' }}">
    <link rel="stylesheet" href="{{ asset('admin/newcustom/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
@endsection
@section('title')
    Product
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @if (session('success_message'))
            <div class="alert alert-success" role="alert">
                {{ session('success_message') }}
            </div>
        @endif
        @if (session('error_message'))
            <div class="alert alert-danger" role="alert">
                {{ session('error_message') }}
            </div>
        @endif
        <div class="title d-flex justify-content-between breadcrumbSpacing">
            <div class="sub-title">
                <h3>Product</h3>
                <a>product </a>
                <span><i class="fa-solid fa-circle fa-xs"></i></span>
                <a>List</a>
            </div>

            <div class="addBtn">
                <a href="{{ route('products.create') }}" class="add-new">
                    Add New
                </a>
            </div>

        </div>

        <div class="main bg-white p-3 justify-content-end">
            <div class="main-search d-flex justify-content-end d-none">
                <div class="product ">
                    <label class="search-lable"><i class="fa-solid fa-magnifying-glass search"></i>
                        <input type="search" class="form-control search1" placeholder="Search Here"
                            aria-controls="DataTables_Table_0"></label>
                </div>
                <div class="quick d-flex">
                    <h3>QUICK FILTERS :</h3>
                    <div class="btn btn-primary me-3 mb-0" role="alert">
                        <a class="status" value="0">IN-ACTIVE</a>
                    </div>
                    <div class="btn btn-primary mb-0" role="alert">
                        <a class="status" value="1">ACTIVE</a>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 col-xl-12 col-sm-12 order-1 order-lg-2 mb-4 mb-lg-0">
                    <table class="table responsive" id="faqstable">
                        <thead>
                            <tr class="id-head">
                                <th>IMAGE</th>
                                <th>NAME</th>
                                <th>PRICE</th>
                                <th>STATUS</th>
                                <th style="text-align: center;">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!-- Script -->
    <script src="{{ asset('newcustom/assets/vendor/js/jquery.min.js') }}"></script>
    <script src="{{ asset('newcustom/assets/vendor/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('newcustom/assets/vendor/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('newcustom/assets/vendor/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    {{-- sweetalert --}}
    <script src="{{ config('constants.BASE_URL_MEDIA') . '/js/customJs.js' }}"></script>
    <script src="{{ config('constants.BASE_URL_MEDIA') . '/vendors/js/extensions/sweetalert2.all.min.js' }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            getListData()
        });

        function getListData() {
            var table = $('#faqstable').DataTable({
                dom: 'Blfrtip',
                "stripeClasses": [],
                paging: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('products.index') }}",
                },
                buttons: [
                ],
                columns: [{
                        data: 'product_image_url',
                        name: 'product_image_url',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            if (row.product_image_url != '' && row.product_image_url != null) {
                                return "<img class=\"imageShow\" src=\"{{ config('constants.BASE_URL_MEDIA') }}/categories/" +
                                    row.product_image_url +"\" height=\"50\" width=\"50\"/>";
                            } else {
                                var noImg = "no_image.jpg";
                                return "<img src=\"{{ config('constants.BASE_URL_MEDIA') }}/admin/images/" +
                                    noImg + "\" height=\"50\" width=\"50\"/>";
                            }
                        }
                    },
                    {
                        data: 'title',
                        name: 'title',
                        orderable: true,
                        class: 'text-left',
                        render: function(data, type, row) {
                            return `
                                <div style="text-transform: capitalize;">
                                        ${row.title}
                                </div>`;
                        }
                    },
                    {
                        data: 'price',
                        name: 'price',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                       drawCallback: function () {
                    // Add custom navigation buttons after DataTable initialization
                    $('#faqstable_previous').before('<li class="paginate_button page-item previous"><a href="#" class="page-link" tabindex="0" id="skipPrevious">Skip Previous 10</a><li>');
                    $('#faqstable_next').after('<li class="paginate_button page-item next"><a class="page-link" href="#" tabindex="0" id="skipNext">Skip Next 10</a>');

                    // Event handler for skipping 10 pages forward
                    $('#skipNext').on('click', function(event) {
                    var currentPage = table.page();
                    var newPage = currentPage + 10;
                    table.page(newPage).draw('page');
                        event.preventDefault();
                    });

                    // Event handler for skipping 10 pages backward
                    $('#skipPrevious').on('click', function(event) {
                    var currentPage = table.page();
                    var newPage = currentPage - 10;
                    newPage = Math.max(newPage, 0); // Ensure the new page is not negative
                    table.page(newPage).draw('page');
                        event.preventDefault();
                    });
                    var currentPage = table.page();
                    if (currentPage < 10) {
                         $('#skipPrevious').prop('disabled', true);
                         } else {
                            $('#skipPrevious').prop('disabled', false);
                        }
                    if (currentPage < 10) {
                         $('#skipNext').prop('disabled', true);
                         } else {
                             $('#skipNext').prop('disabled', false);
                        }
                }
            });
        }
    </script>
@endsection
