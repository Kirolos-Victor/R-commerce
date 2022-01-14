<!doctype html>
<html lang="en"  @if(LaravelLocalization::getCurrentLocaleName()== 'Arabic') dir="rtl" @endif>

<head>

    <meta charset="utf-8" />
    <title>Dashboard | Skote - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('/assets/images/logo/LogoC.jpg')}}">
    <!-- Icons Css -->
    <link href="{{asset("/assets/css/icons.min.css")}}" rel="stylesheet" type="text/css" />
@if(LaravelLocalization::getCurrentLocaleName()== 'Arabic')
    <!-- Bootstrap Css -->
    <link href="{{asset("/assets/css/bootstrap-rtl.min.css")}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset("/assets/css/app-rtl.min.css")}}" id="app-style" rel="stylesheet" type="text/css" />
    @else
    <!-- Bootstrap Css -->
        <link href="{{asset("/assets/css/bootstrap.min.css")}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{asset("/assets/css/app.min.css")}}" id="app-style" rel="stylesheet" type="text/css" />
    @endif
    <link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

</head>

<body data-sidebar="dark" >

<div id="layout-wrapper">

    <!-- ========== Header ========== -->
@include('vendor.includes.header')
<!-- ========== Left Sidebar Start ========== -->
@include('vendor.includes.sidebar')
<!-- Left Sidebar End -->
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content " >

    @yield('content')
    <!-- End Page-content -->
    @include('vendor.includes.footer')
    <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

</div>
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
<script src="{{asset("assets/libs/select2/js/select2.min.js")}}"></script>
<script src="{{asset("assets/js/pages/form-advanced.init.js")}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
<input type="hidden" id="current_vendor_id" value="{{\Illuminate\Support\Facades\Auth::id()}}">
<input type="hidden" id="refresh_route" value="{{route('order.refreshNewOrders')}}">
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="{{ asset('js/vendor/main.js?ver='.time()) }}"></script>
@yield('scripts')


</body>

</html>
