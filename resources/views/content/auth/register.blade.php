<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Sign Up</title>
    <!-- Favicon -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    {{-- eyes --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="css/style.css" />
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('newcustom/assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('newcustom/assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('newcustom/assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('newcustom/assets/vendor/css/rtl/core.css') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('newcustom/assets/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('newcustom/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet"
        href="{{ asset('newcustom/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('newcustom/assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('newcustom/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <!-- Vendor -->
    <link rel="stylesheet"
        href="{{ asset('newcustom/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('newcustom/assets/vendor/css/pages/page-auth.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('newcustom/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('newcustom/assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover authentication-bg d-flex justify-content-center align-items-center vh-100">
    <div class="authentication-inner row w-100 justify-content-center">
        <!-- Register -->
        <div class="col-12 col-lg-5">
            <div class="card shadow-lg p-4">
                <div class="w-100 text-center">
                    <h4 class="mb-3 fw-bold" style="color: #0080ff;">Sign Up</h4>
                </div>
                <form id="formAuthentication" class="mb-3" action="{{ route('register.store') }}" method="POST">
                    @csrf

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

                    <!-- First Name -->
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" value="{{ old('first_name') }}" name="first_name" class="form-control"
                            id="first_name" placeholder="Enter your first name" required />
                    </div>

                    <!-- Last Name -->
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" value="{{ old('last_name') }}" name="last_name" class="form-control"
                            id="last_name" placeholder="Enter your last name" required />
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" value="{{ old('email') }}" name="email" class="form-control"
                            id="email" placeholder="Enter your email" required />
                    </div>

                    <!-- Password -->
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="Password (Min. 8 characters)" minlength="8" required />
                            <span class="input-group-text cursor-pointer">
                                <i class="bi bi-eye-slash toggle-password" data-target="password"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3 form-password-toggle">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" class="form-control"
                                id="password_confirmation" placeholder="Confirm Password" required />
                            <span class="input-group-text cursor-pointer">
                                <i class="bi bi-eye-slash toggle-password" data-target="password_confirmation"></i>
                            </span>
                        </div>
                    </div>

                    <button class="btn btn-primary d-grid w-100" style="background-color:#0080ff">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
</div>


    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js admin/newThemeassets/vendor/js/core.js -->
    <script src="{{ asset('newcustom/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('newcustom/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('newcustom/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('newcustom/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('newcustom/assets/vendor/libs/node-waves/node-waves.js') }}"></script>

    <script src="{{ asset('newcustom/assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('newcustom/assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('newcustom/assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

    <script src="{{ asset('newcustom/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('newcustom/assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('newcustom/assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}">
    </script>
    <script src="{{ asset('newcustom/assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}">
    </script>

    <!-- Main JS -->
    <script src="{{ asset('newcustom/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('newcustom/assets/js/pages-auth.js') }}"></script>
    <script src="{{ asset('newcustom/assets/js/eye-slash.js') }}"></script>

    <script>
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function () {
                let target = document.getElementById(this.getAttribute('data-target'));
                if (target.type === 'password') {
                    target.type = 'text';
                    this.classList.replace('bi-eye-slash', 'bi-eye');
                } else {
                    target.type = 'password';
                    this.classList.replace('bi-eye', 'bi-eye-slash');
                }
            });
        });
    </script>
</body>

</html>
