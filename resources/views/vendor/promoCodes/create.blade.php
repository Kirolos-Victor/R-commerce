@extends('layouts.vendor')
@section('content')
    <!-- Start right Content here -->
    <!-- ============================================================== -->
        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Create Promo Code</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Vendor Admin</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Promo Code</a></li>

                                    <li class="breadcrumb-item active">Create Promo Code</li>
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
                                <form action="{{route('promo-codes.store')}}" method="POST" >
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div>
                                                <div class="form-group mb-4">
                                                    <label for="code">Code <a class="text-primary" style="cursor: pointer" onclick="generateId()">(Generate)</a></label>
                                                    <input id="code" class="form-control input-mask" type="text" name="code" required value="{{old('code')}}">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-4 mt-lg-0">
                                                <div class="form-group mb-4">
                                                    <label for="value">Value</label>
                                                    <input type="text" name="value" id="value" class="form-control input-mask" required value="{{old('value')}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div>
                                                <div class="form-group mb-4">
                                                    <label for="user-limit">User Limit</label>
                                                    <input id="user-limit" class="form-control input-mask" type="number" name="user_limit" required value="{{old('user_limit')}}">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-4 mt-lg-0">
                                                <div class="form-group mb-4">
                                                    <label for="start-date">Starting Date</label>
                                                    <input type="date" name="start_date" id="start-date" class="form-control input-mask" required value="{{old('start_date')}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-4 mt-lg-0">
                                                <div class="form-group mb-4">
                                                    <label for="end-date">Ending Date</label>
                                                    <input type="date" name="end_date" id="end-date" class="form-control input-mask" required value="{{old('end_date')}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mt-4 mt-lg-0">
                                                <div class="form-group mb-4">
                                                    <label for="type">Type</label>

                                                    <select class="form-control"  name="type" id="type">
                                                            <option value="exact_amount">Exact Amount</option>
                                                        <option value="percentage">Percentage</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-4 mt-lg-0">
                                                <div class="form-group mb-4">
                                                    <label for="usage">Type</label>

                                                    <select class="form-control"  name="usage" id="usage">
                                                        <option value="once">Once</option>
                                                        <option value="multiple">Multiple Times</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-4 mt-lg-0">
                                                <div class="form-group mb-4">
                                                    <label for="minimum_total_cart_price">Minimum Total Cart Usage</label>
                                                    <input type="text" name="minimum_total_cart_price" id="minimum_total_cart_price" class="form-control input-mask" required value="{{old('minimum_total_cart_price')}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary mt-2">Create</button>
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
@section('scripts')
    <script>
        function generateId(){
            document.getElementById("code").value =  Math.random().toString(36).substring(2, 8) + Math.random().toString(36).substring(2, 8);

        }

    </script>
    @endsection
