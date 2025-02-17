<!doctype html>

<html
    lang="en"
    class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
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

    <title>Dashboard - AllTrust </title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://newalltrust.ilcorpdev.com/public/assets/img/favicon/favicon.ico" />

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

    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/node-waves/node-waves.css" />

    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/apex-charts/apex-charts.css" />
    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/swiper/swiper.css" />
    <!--<link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />-->
    <!--<link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />-->
    <!--<link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />-->
    <!--<link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />-->


    <!-- Page CSS -->
    <link rel="stylesheet" href="https://newalltrust.ilcorpdev.com/public/assets/vendor/css/pages/cards-advance.css" />

    <!-- Helpers -->
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/js/template-customizer.js"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="https://newalltrust.ilcorpdev.com/public/assets/js/config.js"></script>

    <style>

        .app-brand-logo.demo {
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-pack: center;
            justify-content: center;
            display: -ms-flexbox;
            display: flex;
            width: 180px;
            height: 68px;
        }
        .dark-style .menu .app-brand.demo {
            height: 120px;
        }
        .bg-menu-theme{
            background-color: #1a1a1a !important;
            color: #fff;
        }
        ul a {
            color: #fff !important;
        }
        ul a:hover{
            background: #086898 !important;
        }
    </style>


</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->

       <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="position-fixed">
                <div class="app-brand demo">
        <a href="{{url('/dashboard')}}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="{{url('public/assets/lightlogo.svg')}}" alt="Taxi-Link Logo" width="100%" height="100px" />
            </span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Check if the user has roles other than specific ones -->


        <!-- Adviser Section (Visible if adviser is not null) -->
   @if(auth()->user()->adviser_check != null || auth()->user()->adviser_pending != null || auth()->user()->adviser_existing != null || auth()->user()->adviser_declined != null)
       <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="OnShore">OnShore</div>
            </a>
            <ul class="menu-sub">
                 @if(auth()->user()->adviser_check != null)
                <li class="menu-item">
                    <a href="{{ route('newAdviser') }}" class="menu-link">
                        <div data-i18n="OnShore Registration Form">Adviser Registration Form</div>
                    </a>

                @endif

                 @if(auth()->user()->adviser_pending != null)
                <li class="menu-item">
                    <a href="{{ route('newAdviser-pending') }}" class="menu-link">
                        <div data-i18n="Pending Adviser">Pending Adviser</div>
                    </a>
                </li>
                @endif
                 @if(auth()->user()->adviser_existing != null)
                <li class="menu-item">
                    <a href="{{ route('newAdviser-existing') }}" class="menu-link">
                        <div data-i18n="Existing Adviser">Existing Adviser</div>
                    </a>
                </li>
                @endif
                
                @if(auth()->user()->adviser_declined != null)
                  <li class="menu-item">
                    <a href="{{ route('adviser.declinedList') }}" class="menu-link">
                        <div data-i18n="Declined Adviser">Declined Adviser</div>
                    </a>
                </li>
                  @endif
                
            </ul>
        </li>
        @endif



@if(auth()->user()->offshore_check != null || auth()->user()->offshore_pending != null || auth()->user()->offshore_existing != null || auth()->user()->offshore_declined != null)
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
             <i class="menu-icon tf-icons ti ti-clipboard"></i>
                <div data-i18n="OffShore">OffShore</div>
            </a>
            <ul class="menu-sub">
@if(auth()->user()->offshore_check != null)
                <li class="menu-item">
                    <a href="{{ route('newOffshore') }}" class="menu-link">
                        <div data-i18n="Offshore Registration form">Offshore Registration form</div>
                    </a>
            </li>
            @endif
            @if(auth()->user()->offshore_pending != null)
            <li class="menu-item">
                <a href="{{ route('offshore.pendingList') }}" class="menu-link">
                    <div data-i18n="Pending Offshore">Pending Offshore</div>
                </a>
            </li>
            @endif
            @if(auth()->user()->offshore_existing != null)
<li class="menu-item">
            <a href="{{ route('offshore.existingList') }}" class="menu-link">
                <div data-i18n="Existing Offshore">Existing Offshore </div>
            </a>
             </li>
@endif
 @if(auth()->user()->offshore_declined != null)
<li class="menu-item">
            <a href="{{ route('offshore.declinedList') }}" class="menu-link">
                <div data-i18n="Declined Offshore">Declined Offshore</div>
            </a>
        </li>
        
     @endif

            </ul>
        </li>

@endif

 @if(auth()->user()->oasis_sipp__check != null || auth()->user()->sipp_property_check != null || auth()->user()->full_sipp_check != null || auth()->user()->ftp_check != null || auth()->user()->decline_applications != null)

        <!-- Members Section -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-layout-sidebar"></i>
                <div data-i18n="Member Applications">Member Applications</div>
            </a>
            <ul class="menu-sub">

                @if(auth()->user()->oasis_sipp__check != null)

                <li class="menu-item">
                    <a href="{{ route('members-before') }}" class="menu-link">
                        <div data-i18n="Create Oasis SIPP">Create Oasis SIPP</div>
                    </a>
                </li>
                @endif

                @if(auth()->user()->sipp_property_check != null)
                <li class="menu-item">
                    <a href="{{ route('members-before2') }}" class="menu-link">
                        <div data-i18n="Create SIPP Property">Create SIPP Property</div>
                    </a>
                </li>
                @endif

                @if(auth()->user()->full_sipp_check != null)
                <li class="menu-item">
                    <a href="{{ route('members-before2') }}" class="menu-link">
                        <div data-i18n="Create Full SIPP">Create Full SIPP</div>
                    </a>
                </li>
                @endif

                @if(auth()->user()->ftp_check != null)
                <li class="menu-item">
                    <a href="{{ route('members-before3') }}" class="menu-link">
                        <div data-i18n="Create FPT">Create FPT</div>
                    </a>
                </li>

                @endif

            @if(auth()->user()->pending_applications != null)
                <li class="menu-item">
                    <a href="{{ route('members.oasis.pending') }}" class="menu-link">
                        <div data-i18n="Pending Application">Pending Application</div>
                    </a>
                </li>
            @endif
  @if(auth()->user()->existing_applications != null)
                <li class="menu-item">
                    <a href="{{ route('members.oasis.existing') }}" class="menu-link">
                        <div data-i18n="Existing Applications">Existing Applications</div>
                    </a>
                </li>
                @endif
                
                @if(auth()->user()->decline_applications != null)
                 <li class="menu-item">
                    <a href="{{ route('member.declinedList') }}" class="menu-link">
                        <div data-i18n="Declined Members">Declined Members</div>
                    </a>
                </li>
                @endif

            </ul>
        </li>

        @endif


           @if(auth()->user()->member_details_check != null || auth()->user()->illustration_check != null)
         <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-files"></i>
                <div data-i18n="Members">Members</div>
            </a>
            <ul class="menu-sub">

                  @if(auth()->user()->member_details_check != null)
                <li class="menu-item">
                    <a href="{{ route('members-details') }}" class="menu-link">
                        <div data-i18n="Member Details">Member Details</div>
                    </a>
                </li>
                @endif

                        @if(auth()->user()->illustration_check != null)
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div data-i18n="Illustration">Illustration</div>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif



        <!-- Management Section (Only if user is not advisor) -->
        @if(auth()->user()->leads_check != null || auth()->user()->user_management_check != null || auth()->user()->dms_check != null || auth()->user()->reports_check != null || auth()->user()->workflow_check != null)
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-folder"></i>
                <div data-i18n="Management">Management</div>
            </a>
            <ul class="menu-sub">
                @if(auth()->user()->leads_check != null)
                <li class="menu-item">
                    <a href="{{ route('leads.index') }}" class="menu-link">
                        <div data-i18n="Leads">Leads</div>
                    </a>
                </li>
                @endif

                @if(auth()->user()->user_management_check != null)
                <li class="menu-item">
                    <a href="{{ route('user') }}" class="menu-link">
                        <div data-i18n="User Management">User Management</div>
                    </a>
                </li>
                @endif

                @if(auth()->user()->dms_check != null)
                <li class="menu-item">
                    <a href="{{ route('dms.index') }}" class="menu-link">
                        <div data-i18n="DMS">DMS</div>
                    </a>
                </li>
                @endif

                @if(auth()->user()->reports_check != null)
                <li class="menu-item">
                    <a href="{{ route('report.index') }}" class="menu-link">
                        <div data-i18n="Reports">Reports</div>
                    </a>
                </li>
                @endif

                @if(auth()->user()->workflow_check != null)
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div data-i18n="WorkFLow">WorkFLow</div>
                    </a>
                </li>
                @endif
            </ul>
        </li>
        @endif


 @if(auth()->user()->tickets_check != null || auth()->user()->support_check != null || auth()->user()->faq_check != null)
        <!-- Support Section (Always visible) -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-help"></i>
                <div data-i18n="Support">Support</div>
            </a>
            <ul class="menu-sub">
                @if(auth()->user()->tickets_check != null)
                <li class="menu-item">
                    <a href="{{ route('ticket') }}" class="menu-link">
                        <div data-i18n="Tickets">Tickets</div>
                    </a>
                </li>
                @endif

                @if(auth()->user()->support_check != null)
                <li class="menu-item">
                    <a href="{{ route('support') }}" class="menu-link">
                        <div data-i18n="Support">Support</div>
                    </a>
                </li>
                @endif

                @if(auth()->user()->faq_check != null)
                <li class="menu-item">
                    <a href="{{ route('faq') }}" class="menu-link">
                        <div data-i18n="FAQ">FAQ</div>
                    </a>
                </li>
                @endif
            </ul>
        </li>
@endif

 @if(auth()->user()->communication_check != null)
        <!-- Marketing Management -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-briefcase"></i>
                <div data-i18n="Marketing Management">Marketing Management</div>
            </a>
            <ul class="menu-sub">

                <li class="menu-item">
                    <a href="{{ route('mail.index') }}" class="menu-link">
                        <div data-i18n="Communications">Communications</div>
                    </a>
                </li>

            </ul>
        </li>
  @endif

   @if(auth()->user()->adviser_applications_check != null || auth()->user()->member_applications_check != null)
        <!-- Adviser Application -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-archive"></i>
                <div data-i18n="Archive">Archive</div>
            </a>
            <ul class="menu-sub">
                @if(auth()->user()->adviser_applications_check != null)
                <li class="menu-item">
                    <a href="{{ route('deletedAdvisers') }}" class="menu-link">
                        <div data-i18n="Advisor Applications">Advisor Applications</div>
                    </a>
                </li>
                @endif
                @if(auth()->user()->member_applications_check != null)
                 <li class="menu-item">
                            <a href="{{ route('deleted.members') }}" class="menu-link">
                                <div data-i18n="Member Applications">Member Applications</div>
                            </a>
                        </li>
                @endif
                <!--<li class="menu-item">-->
                <!--    <a href="{{ route('deletedoffshore') }}" class="menu-link">-->
                <!--        <div data-i18n="Offshore Applications">Offshore Applications</div>-->
                <!--    </a>-->
                <!--</li>-->
                  

               <!--  @if(auth()->user()->ftp_check != null)
                   <li class="menu-item">
                            <a href="{{ route('deletedfpt') }}" class="menu-link">
                                <div data-i18n="FPT Applications">FPT Applications</div>
                            </a>
                        </li>
                        @endif-->
            </ul>
        </li>

        @endif
       
    </ul>
        </div>
</aside>

        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            <nav
                class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                id="layout-navbar">
                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                        <i class="ti ti-menu-2 ti-md"></i>
                    </a>
                </div>

                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                    <!-- Search -->
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item navbar-search-wrapper mb-0">
                            <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">
                                <i class="ti ti-search ti-md me-2 me-lg-4 ti-lg"></i>
                                <span class="d-none d-md-inline-block text-muted fw-normal">Search (Ctrl+/)</span>
                            </a>
                        </div>
                    </div>
                    <!-- /Search -->

                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <!-- Language -->

                        <!--/ Language -->



                        <!-- User -->
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a
                                class="nav-link dropdown-toggle hide-arrow p-0"
                                href="javascript:void(0);"
                                data-bs-toggle="dropdown">
                                <div class="avatar avatar-online">
                                    <img src="public/assets/img/avatars/1.png" alt class="rounded-circle" />
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item mt-0" href="pages-account-settings-account.html">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-2">
                                                <div class="avatar avatar-online">
                                                    <img src="public/assets/img/avatars/1.png" alt class="rounded-circle" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-0">{{auth()->user()->name}}</h6>
                                                <small class="text-muted">{{auth()->user()->role}}</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <!-- Email Notification Toggle Button -->
                                <li class="px-2 pt-2">
                                    @if(auth()->user()->email_notification == 'yes')
                                        <a href="{{ route('toggle.email.notification') }}" class="btn btn-sm btn-warning w-100">Email Notification OFF</a>
                                    @else
                                        <a href="{{ route('toggle.email.notification') }}" class="btn btn-sm btn-success w-100">Email Notification ON</a>
                                    @endif
                                </li>
                                <div class="d-grid px-2 pt-2 pb-1">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <button class="btn btn-sm btn-danger d-flex" type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <small class="align-middle">Logout</small>
                                        <i class="ti ti-logout ms-2 ti-14px"></i>
                                    </button>
                                </div>

                                </li>
                            </ul>
                        </li>
                        <!--/ User -->
                    </ul>
                </div>


            </nav>

            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">

                    @yield('content')
                    
                    
                    
                    
                    
                    

                </div>

                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl">
                        <div
                            class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">

                        </div>
                    </div>
                </footer>
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
</div>
<!-- / Layout wrapper -->

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->


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
<script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/apex-charts/apexcharts.js"></script>
<script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/swiper/swiper.js"></script>
<!--<script src="https://newalltrust.ilcorpdev.com/public/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>-->
<!--   <script src="https://newalltrust.ilcorpdev.com/public/assets/js/tables-datatables-basic.js"></script>-->

<!-- Main JS -->
<script src="https://newalltrust.ilcorpdev.com/public/assets/js/main.js"></script>
<!--<script src="https://newalltrust.ilcorpdev.com/public/assets/js/pages-auth-multisteps.js"></script>-->
@yield('script')

{{--<!-- Page JS -->--}}
<script src="https://newalltrust.ilcorpdev.com/public/assets/js/dashboards-analytics.js"></script>
</body>
</html>
