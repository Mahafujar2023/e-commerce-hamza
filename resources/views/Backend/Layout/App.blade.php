<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
<<<<<<< HEAD
        <link rel="shortcut icon" href="{{ asset('backend-assets/images/favicon.ico') }}">
        @stack('page-wise-css')
        <!-- Bootstrap Css -->
        <link href="{{ asset('backend-assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('backend-assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('backend-assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
        @yield('style')
    </head>
=======
        <link rel="shortcut icon" href="{{ asset('Backend/assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    @yield('style')
</head>
>>>>>>> f4e247c70b7946bdcac396684ec0cb3dcda1e907

<body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

<<<<<<< HEAD
            <!-- ==========Header Start ========== -->
            @include('backend.include.header')
            <!-- ========== Header Start ========== -->


            <!-- ========== Left Sidebar Start ========== -->
            @include('backend.Include.Menu')
            <!-- Left Sidebar End -->
=======
        <!-- ==========Header Start ========== -->
        @include('Backend.Include.Header')
        <!-- ========== Header Start ========== -->


        <!-- ========== Left Sidebar Start ========== -->
        @include('Backend.Include.Menu')
        <!-- Left Sidebar End -->
>>>>>>> f4e247c70b7946bdcac396684ec0cb3dcda1e907



<<<<<<< HEAD
                <div class="page-content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                    <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                

               @include('backend.Include.footer')
=======
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    @section('content')
                </div>
                <!-- container-fluid -->
>>>>>>> f4e247c70b7946bdcac396684ec0cb3dcda1e907
            </div>
            <!-- End Page-content -->



            @include('Backend.Include.Footer')
        </div>
        <!-- end main content-->

<<<<<<< HEAD
        <!-- Right Sidebar -->
        {{-- @include('backend.Include.Right_sidebar') --}}
        <!-- /Right-bar -->
=======
    </div>
    <!-- END layout-wrapper -->
>>>>>>> f4e247c70b7946bdcac396684ec0cb3dcda1e907

    <!-- Right Sidebar -->
    @include('Backend.Include.Right_sidebar')
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
<<<<<<< HEAD
        <script src="{{ asset('backend-assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('backend-assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('backend-assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('backend-assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('backend-assets/libs/node-waves/waves.min.js') }}"></script>

        <!-- apexcharts -->
        <script src="{{ asset('backend-assets/libs/apexcharts/apexcharts.min.js') }}"></script>
=======
        <script src="{{ asset('Backend/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('Backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        {{-- this link is off write now --}}
        {{-- <script src="{{ asset('Backend/assets/libs/metismenu/metisMenu.min.js') }}"></script> --}}
        <script src="{{ asset('Backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('Backend/assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- apexcharts -->
    <script src="{{ asset('Backend/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
>>>>>>> f4e247c70b7946bdcac396684ec0cb3dcda1e907

        <!-- dashboard init -->
        <script src="{{ asset('backend-assets/js/pages/dashboard.init.js') }}"></script>

        @stack('page-wise-script')

<<<<<<< HEAD
        <!-- App js -->
        <script>
            var bootstrapAssetUrl = "{{ asset('backend-assets/css/bootstrap.min.css') }}";
            var appAssetUrl = "{{ asset('backend-assets/css/app.min.css') }}";

            //dark option exist but below tow files not exist
            var bootstrapAssetUrlDark = "{{ asset('backend-assets/css/bootstrap-dark.min.css') }}";
            var appAssetUrlDark = "{{ asset('backend-assets/css/app-dark.min.css') }}";
        </script>
        <script src="{{ asset('backend-assets/js/app.js') }}"></script>
=======
    <!-- App js -->
    <script src="{{ asset('Backend/assets/js/app.js') }}"></script>
>>>>>>> f4e247c70b7946bdcac396684ec0cb3dcda1e907

    @yield('script')
</body>

</html>
