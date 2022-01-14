@extends('layouts.vendor')
@section('content')
    <!-- Start right Content here -->
    <!-- ============================================================== -->
        <div class="page-content" id="app">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Create Addon</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Vendor Admin</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Addons</a></li>

                                    <li class="breadcrumb-item active">Create Addon</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <create-addon :route-create-addon="'{{route('addons.store')}}'"></create-addon>

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->


        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script> © Skote.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Design & Develop by Themesbrand
                        </div>
                    </div>
                </div>
            </div>
        </footer>

    <!-- end main content-->
@endsection
@section('scripts')
    <script src="{{ asset('js/app.js') }}" defer></script>

@endsection

