<!-- Navbar -->
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar" style="background-color: #0080ff  !important;">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="ti ti-menu-2 ti-sm"></i>
        </a>
    </div>
    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Header Navbar -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item navbar-search-wrapper mb-0">
                <a href="{{ route('dashboard') }}" class="app-brand-link">
                    <span class="app-brand-logo demo">
                        <img src="{{ asset('admin/newcustom/assets/img/Bitmap.png') }}" alt="">
                    </span>
                </a>
            </div>
        </div>

        <div class="container" style="float:right">
            <div class="dropdown" style="float:inherit">
                <!-- Log out dropdown -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown log_out_dropdown" style="display: contents">
                    <!-- Add form for logout -->
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">

                        @csrf
                        <button type="submit" class="nav-link dropdown-toggle" style="background: none; border: none;">
                            <div class="avatar avatar-online">
                                <p class="m-0 text-white">Logout</p>
                            </div>
                        </button>
                    </form>
                </li>
                <!-- Log out dropdown -->
            </div>
        </div>
        <!-- Header Navbar End -->
    </div>
    <!-- Search Small Screens -->
    <div class="navbar-search-wrapper search-input-wrapper d-none">
        <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..."
            aria-label="Search...">
        <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
    </div>

</nav>
<!-- / Navbar -->
