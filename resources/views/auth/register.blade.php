<!doctype html>

<html
    lang="en"
    class="light-style layout-wide customizer-hide"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="public/assets/"
    data-template="vertical-menu-template"
    data-style="light">
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="public/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="public/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="public/assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="public/assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->

    <link rel="stylesheet" href="public/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="public/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />

    <link rel="stylesheet" href="public/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="public/assets/vendor/libs/node-waves/node-waves.css" />

    <link rel="stylesheet" href="public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="public/assets/vendor/libs/typeahead-js/typeahead.css" />
    <!-- Vendor -->
    <link rel="stylesheet" href="public/assets/vendor/libs/@form-validation/form-validation.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="public/assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="public/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="public/assets/vendor/js/template-customizer.js"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="public/assets/js/config.js"></script>

    <style>

        .app-brand-logo.demo {
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-pack: center;
            justify-content: center;
            display: -ms-flexbox;
            display: flex;
            width: 200px;
            height: 68px;
        }
        .form-control:focus {
            color: #fff;
        }
        .form-control {
            color: #fff;
        }
    </style>

</head>

<body>
<!-- Content -->

{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Register') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('register') }}">--}}
{{--                        @csrf--}}

{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}



<div class="authentication-wrapper authentication-cover">
    <!-- Logo -->
    <a href="index.html" class="app-brand auth-cover-brand">
        <span class="app-brand-logo demo">
            <span class="app-brand-logo demo">
           <img src="{{url('public/assets/lightlogo.svg')}}" alt="Taxi-Link Logo" width="100%" height="115px"/>
        </span>
        </span>
    </a>
    <!-- /Logo -->
    <div class="authentication-inner row m-0">
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-8 p-0"  style="background: #335a7b;">
            <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                <img
                    src="../../assets/img/illustrations/auth-register-illustration-light.png"
                    alt="auth-register-cover"
                    class="my-5 auth-illustration"
                    data-app-light-img="illustrations/auth-register-illustration-light.png"
                    data-app-dark-img="illustrations/auth-register-illustration-dark.png" />

                <img
                    src="../../assets/img/illustrations/bg-shape-image-light.png"
                    alt="auth-register-cover"
                    class="platform-bg"
                    data-app-light-img="illustrations/bg-shape-image-light.png"
                    data-app-dark-img="illustrations/bg-shape-image-dark.png" />
            </div>
        </div>
        <!-- /Left Text -->

        <!-- Register -->
        <div class="d-flex col-12 col-lg-4 align-items-center authentication-bg p-sm-12 p-6" style="background: #000;">
            <div class="w-px-400 mx-auto mt-12 pt-5">
                <h4 class="mb-1" style="color: #fff;">Welcome to Alltrust! 👋</h4>
                <p class="mb-6" style="color: #fff;">Please register to your account and start the adventure</p>

                <form id="formAuthentication" class="mb-6" action="{{ route('register') }}" method="POST">
                @csrf

                    {{-- name --}}
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label " style="color: #fff;">{{ __('Name') }}</label>

                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    
                         <div class="row mb-3">
                        <label for="firm_name" class="col-md-4 col-form-label " style="color: #fff;">{{ __('Firm Name') }}</label>

                        <div class="col-md-12">
                            <input id="firm_name" type="text" class="form-control @error('firm_name') is-invalid @enderror" name="firm_name" value="{{ old('firm_name') }}" required autocomplete="name" autofocus>

                            @error('firm_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    
                    {{-- email --}}
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label " style="color: #fff;">{{ __('Email Address') }}</label>

                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    {{-- password --}}
                    <div class="row mb-3">
                        <label for="password" class="col-md-4 mb-0 col-form-label " style="color: #fff;">{{ __('Password') }}</label>

                        <div class="col-md-12 ">
                            <input id="password" type="password" class="form-control mt-0 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-6 mt-8">
                        <div class="form-check mb-8 ms-2">
                            <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                            <label class="form-check-label" for="terms-conditions" style="color: #fff;">
                                I agree to
                                <a href="javascript:void(0);">privacy policy & terms</a>
                            </label>
                        </div>
                    </div>

                            <button type="submit" class="btn btn-primary d-grid w-100">
                                {{ __('Register') }}
                            </button>

                </form>

                <p class="text-center">
                    <span style="color: #fff;">Already have an account?</span>
                    <a href="{{ route('login')}} ">
                        <span>Login</span>
                    </a>
                </p>



            </div>
        </div>
        <!-- /Register -->
    </div>
</div>


<script src="public/assets/vendor/libs/jquery/jquery.js"></script>
<script src="public/assets/vendor/libs/popper/popper.js"></script>
<script src="public/assets/vendor/js/bootstrap.js"></script>
<script src="public/assets/vendor/libs/node-waves/node-waves.js"></script>
<script src="public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="public/assets/vendor/libs/hammer/hammer.js"></script>
<script src="public/assets/vendor/libs/i18n/i18n.js"></script>
<script src="public/assets/vendor/libs/typeahead-js/typeahead.js"></script>
<script src="public/assets/vendor/js/menu.js"></script>

<!-- endbuild -->

<!-- Vendors JS -->
<script src="public/assets/vendor/libs/@form-validation/popular.js"></script>
<script src="public/assets/vendor/libs/@form-validation/bootstrap5.js"></script>
<script src="public/assets/vendor/libs/@form-validation/auto-focus.js"></script>

<!-- Main JS -->
<script src="public/assets/js/main.js"></script>

<!-- Page JS -->
<script src="public/assets/js/pages-auth.js"></script>
</body>
</html>


