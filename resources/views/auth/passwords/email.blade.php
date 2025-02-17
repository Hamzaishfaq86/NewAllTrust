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

    <title>Forgot Password Cover - Pages | Vuexy - Bootstrap Admin Template</title>

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
    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->

    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />

    <link rel="stylesheet" href="public/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/node-waves/node-waves.css" />

    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/typeahead-js/typeahead.css" />
    <!-- Vendor -->
    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/@form-validation/form-validation.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/js/template-customizer.js"></script>

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

    <div class="authentication-wrapper authentication-cover">
      <!-- Logo -->
      <a  class="app-brand auth-cover-brand">
        <span class="app-brand-logo demo">
           <img src="{{url('public/assets/lightlogo.svg')}}" alt="Taxi-Link Logo" width="100%" height="115px"/>
        </span>
{{--        <span class="app-brand-text demo text-heading fw-bold">Vuexy</span>--}}
    </a>
      <!-- /Logo -->
      <div class="authentication-inner row m-0">
        <!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-8 p-0">
          <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center" style="background-color: #335a7b;">
            <img
              src="https://newalltrust.ilcorpdev.com/public/assets/img/illustrations/auth-forgot-password-illustration-light.png"
              alt="auth-forgot-password-cover"
              class="my-5 auth-illustration d-lg-block d-none"
              data-app-light-img="illustrations/auth-forgot-password-illustration-light.png"
              data-app-dark-img="illustrations/auth-forgot-password-illustration-dark.png" />

            <img
              src="https://newalltrust.ilcorpdev.com/public/assets/img/illustrations/bg-shape-image-light.png"
              alt="auth-forgot-password-cover"
              class="platform-bg"
              data-app-light-img="illustrations/bg-shape-image-light.png"
              data-app-dark-img="illustrations/bg-shape-image-dark.png" />
          </div>
        </div>
        <!-- /Left Text -->

        <!-- Forgot Password -->
        <div class="d-flex col-12 col-lg-4 align-items-center authentication-bg p-sm-12 p-6" style="background-color: #000;">
          <div class="w-px-400 mx-auto mt-12 mt-5">
            <h4 class="mb-1" style="color: #fff;">Forgot Password? 🔒</h4>
            <p class="mb-6" style="color: #fff;">Enter your email and we'll send you instructions to reset your password</p>
            <form id="formAuthentication" class="mb-6" action="auth-reset-password-cover.html" method="GET" action="{{ route('password.email') }}">
              <div class="mb-6">
                <label for="email" class="form-label" style="color: #fff;">{{ __('Email Address') }}</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required placeholder="Enter your email" value="{{ old('email') }}" autofocus />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
              <button class="btn btn-primary d-grid w-100">{{ __('Send Password Reset Link') }}</button>
            </form>
            <div class="text-center">
              <a href="auth-login-cover.html" class="d-flex align-items-center justify-content-center">
                <i class="ti ti-chevron-left scaleX-n1-rtl me-1_5"></i>
                Back to login
              </a>
            </div>
          </div>
        </div>
        <!-- /Forgot Password -->
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/popper/popper.js"></script>
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/js/bootstrap.js"></script>
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/@form-validation/auto-focus.js"></script>

    <!-- Main JS -->
    <script src="public/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="public/assets/js/pages-auth.js"></script>
  </body>
</html>
