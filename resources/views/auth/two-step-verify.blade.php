 

 
<!doctype html>

<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
     data-assets-path="https://newalltrust.ilcorpdev.com/public/assets/"
  data-template="vertical-menu-template"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Two Steps Verifications Cover - Pages | Vuexy - Bootstrap Admin Template</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://newalltrust.ilcorpdev.com/public/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" /> 
    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/fonts/flag-icons.css" /> 
    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/css/demo.css" /> 
    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/node-waves/node-waves.css" /> 
    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/typeahead-js/typeahead.css" /> 
    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/@form-validation/form-validation.css" /> 
    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/css/pages/page-auth.css" /> 
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/js/helpers.js"></script> 
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/js/template-customizer.js"></script>
 
    <script src="https://newalltrust.ilcorpdev.com/public/assets/js/config.js"></script>
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
          <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
            <img
              src="https://newalltrust.ilcorpdev.com/public/assets/img/illustrations/auth-two-step-illustration-light.png"
              alt="auth-two-steps-cover"
              class="my-5 auth-illustration"
              data-app-light-img="illustrations/auth-two-step-illustration-light.png"
              data-app-dark-img="illustrations/auth-two-step-illustration-dark.png" />

            <img
              src="https://newalltrust.ilcorpdev.com/public/assets/img/illustrations/bg-shape-image-light.png"
              alt="auth-two-steps-cover"
              class="platform-bg"
              data-app-light-img="illustrations/bg-shape-image-light.png"
              data-app-dark-img="illustrations/bg-shape-image-dark.png" />
          </div>
        </div>
        <!-- /Left Text -->

        <!-- Two Steps Verification -->
        <div class="d-flex col-12 col-lg-4 align-items-center authentication-bg p-6 p-sm-12" style="background: #000;">
          <div class="w-px-400 mx-auto mt-12 mt-5">
            <h4 class="mb-1" style="color: #fff;">Two Step Verification 💬</h4>
            <p class="text-start mb-6" style="color: #fff;">
              We sent a verification code to your mobile. Enter the code from the mobile in the field below.
              <span class="fw-medium d-block mt-1 text-heading" style="color: #fff;" >******1234</span>
            </p>
               <label for="two_step_code" style="color: #fff;">Enter the code sent to your email:</label>
            <form method="POST" action="{{ route('verify-step') }}" id="twoStepsForm" >
                 @csrf
              <div class="mb-6">
                <div class="auth-input-wrapper d-flex align-items-center justify-content-between numeral-mask-wrapper">
                <input type="text" name="two_step_code" id="two_step_code" class="form-control" required><br>
                </div>
                <span class="text-danger">
                                    @if($errors->any())
    <div style="width:100%;">
        <strong>Error:</strong> {{ $errors->first('two_step_code') }}
    </div>
@endif
                </span>
              </div>
              <button type="submit" class="btn btn-primary d-grid w-100 mb-6">Verify my account</button>
              <div class="text-center" style="color: #fff;">
                Didn't get the code?
                <!--<a href="{{ route('resend-code') }}">Resend Code</a>-->
              </div>
            </form>
          </div>
        </div>
     
      </div>
    </div>
 

    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/popper/popper.js"></script>
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/js/bootstrap.js"></script>
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/js/menu.js"></script>
 
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/cleavejs/cleave.js"></script>
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/@form-validation/auto-focus.js"></script>
 
    <script src="https://newalltrust.ilcorpdev.com/public/assets/js/main.js"></script>
 
    <script src="https://newalltrust.ilcorpdev.com/public/assets/js/pages-auth.js"></script>
    <script src="https://newalltrust.ilcorpdev.com/public/assets/js/pages-auth-two-steps.js"></script>
  </body>
</html>
