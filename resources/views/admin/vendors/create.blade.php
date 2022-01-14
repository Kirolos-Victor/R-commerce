@extends('layouts.admin')
@section('content')
    <!-- Start right Content here -->
    <!-- ============================================================== -->
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Create Vendor</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                    <li class="breadcrumb-item active">Create Vendor</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                    @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="card-body">
                                <form action="{{route('vendors.store')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div>
                                                <div class="form-group mb-4">
                                                    <label for="english-name">English Name</label>
                                                    <input id="english-name" class="form-control input-mask" type="text" name="name_en" >
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-4 mt-lg-0">
                                                <div class="form-group mb-4">
                                                    <label for="arabic-name">Arabic Name</label>
                                                    <input type="text" name="name_ar" id="arabic-name" class="form-control input-mask" >
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-lg-6">
                                        <div class="mt-4 mt-lg-0">
                                            <div class="form-group mb-4">
                                                <label for="url">URL</label>
                                                <input type="text" name="url" id="url" class="form-control input-mask"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-4 mt-lg-0">
                                            <div class="form-group mb-4">
                                                <label for="supplier_code">Supplier Code</label>
                                                <input type="text" name="supplier_code" id="supplier_code" class="form-control input-mask" >
                                            </div>
                                        </div>
                                    </div>
                                        <div class="col-lg-6">
                                            <div class="mt-4 mt-lg-0">
                                                <div class="form-group mb-4">
                                                    <label for="location">Location</label>
                                                    <input type="text" name="location" id="location" class="form-control input-mask" >
                                                </div>
                                            </div>
                                        </div>
                                <div class="col-lg-6">
                                    <div class="mt-4 mt-lg-0">
                                        <div class="form-group mb-4">
                                            <label for="countries">Countries</label>
                                            <select type="text" name="country_id" id="countries" class="form-control input-mask" >
                                                @foreach($countries as $country)
                                                        <option value="{{$country->id}}">{{$country->name_en}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                        <div class="col-lg-6">
                                            <div class="mt-4 mt-lg-0">
                                                <div class="form-group mb-4">
                                                    <label for="start_working_hours">Starting Working Time</label>
                                                    <input type="text" name="start_working_hours" id="start_working_hours" class="form-control input-mask" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-4 mt-lg-0">
                                                <div class="form-group mb-4">
                                                    <label for="end_working_hours">Ending Working Time</label>
                                                    <input type="text" name="end_working_hours" id="end_working_hours" class="form-control input-mask" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-4 mt-lg-0">
                                                <div class="form-group mb-4">
                                                    <label for="start_delivery_time">Starting Delivery Time</label>
                                                    <input type="text" name="start_delivery_time" id="start_delivery_time" class="form-control input-mask" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-4 mt-lg-0">
                                                <div class="form-group mb-4">
                                                    <label for="end_delivery_time">Ending Delivery Time</label>
                                                    <input type="text" name="end_delivery_time" id="end_delivery_time" class="form-control input-mask" >
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-lg-6">
                                        <div class="mt-4 mt-lg-0">
                                            <div class="form-group mb-4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="active" name="active">
                                                    <label class="form-check-label" for="active">Vendor Activation</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="col-lg-6">
                                            <div class="mt-4 mt-lg-0">
                                                <div class="form-group mb-4">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="preorder_availability" name="preorder_availability">
                                                        <label class="form-check-label" for="preorder_availability">Pre-order Availability</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Create</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

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
