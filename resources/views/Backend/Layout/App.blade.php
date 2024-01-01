<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="{{ asset('backend-assets/images/favicon.ico') }}">
        @stack('page-wise-css')
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <!-- Bootstrap Css -->
        <link href="{{ asset('backend-assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('backend-assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('backend-assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
        @yield('style')
    </head>

    <body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            <!-- ==========Header Start ========== -->
            @include('backend.include.header')
            <!-- ========== Header Start ========== -->


            <!-- ========== Left Sidebar Start ========== -->
            @include('backend.include.menu')
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                

               @include('backend.Include.footer')
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        {{-- @include('backend.Include.Right_sidebar') --}}
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="{{ asset('backend-assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('backend-assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('backend-assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('backend-assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('backend-assets/libs/node-waves/waves.min.js') }}"></script>

        <!-- apexcharts -->
        {{-- <script src="{{ asset('backend-assets/libs/apexcharts/apexcharts.min.js') }}"></script> --}}

        <!-- dashboard init -->
        {{-- <script src="{{ asset('backend-assets/js/pages/dashboard.init.js') }}"></script> --}}

        @stack('page-wise-script')
        @include('backend.include.toast')
        <!-- App js -->
        <script>
            var bootstrapAssetUrl = "{{ asset('backend-assets/css/bootstrap.min.css') }}";
            var appAssetUrl = "{{ asset('backend-assets/css/app.min.css') }}";

            //dark option exist but below tow files not exist
            var bootstrapAssetUrlDark = "{{ asset('backend-assets/css/bootstrap-dark.min.css') }}";
            var appAssetUrlDark = "{{ asset('backend-assets/css/app-dark.min.css') }}";
        </script>
        <script src="{{ asset('backend-assets/js/app.js') }}"></script>

        @stack('script')
       
    </body>

</html>
