<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Dashboard | Skote - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('/assets/images/favicon.ico')}}">

    <!-- Bootstrap Css -->
    <link href="{{asset("/assets/css/bootstrap.min.css")}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset("/assets/css/icons.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset("/assets/css/app.min.css")}}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body data-sidebar="dark">

<!-- <body data-layout="horizontal" data-topbar="dark"> -->
<!-- Begin page -->
<div id="layout-wrapper">
    <!-- ========== Header ========== -->
@include('admin.includes.header')
    <!-- ========== Left Sidebar Start ========== -->
    @include('admin.includes.sidebar')
    <!-- Left Sidebar End -->
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
@yield('content')
        <!-- End Page-content -->
@include('admin.includes.footer')
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
<div class="right-bar">
    <div data-simplebar class="h-100">
        <div class="rightbar-title d-flex align-items-center px-3 py-4">

            <h5 class="m-0 me-2">Settings</h5>

            <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
        </div>

    </div> <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>
</div>
<!-- JAVASCRIPT -->
<script src="{{asset('/assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('/assets/libs/node-waves/waves.min.js')}}"></script>

<!-- apexcharts -->
<script src="{{asset('/assets/libs/apexcharts/apexcharts.min.js')}}"></script>

<!-- dashboard init -->
<script src="{{asset('/assets/js/pages/dashboard.init.js')}}"></script>

<!-- App js -->
<script src="{{asset('/assets/js/app.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@yield('scripts')
</body>

</html>
