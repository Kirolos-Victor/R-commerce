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
                            <h4 class="mb-sm-0 font-size-18">Create Vendor Admin</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                    <li class="breadcrumb-item active">Create Vendor Admin</li>
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
                                <form action="{{route('vendor-users.store')}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div>
                                                <div class="form-group mb-4">
                                                    <label for="name">Name</label>
                                                    <input id="name" class="form-control input-mask" type="text" name="name" value="{{old('name')}}">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-4 mt-lg-0">
                                                <div class="form-group mb-4">
                                                    <label for="email">Email</label>
                                                    <input type="text" name="email" id="email" class="form-control input-mask" value="{{old('email')}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-4 mt-lg-0">
                                                <div class="form-group mb-4">
                                                    <label for="password">Password</label>
                                                    <input type="password" name="password" id="password" class="form-control input-mask"  >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-4 mt-lg-0">
                                                <div class="form-group mb-4">
                                                    <label for="type">Select Type</label>
                                                    <select type="text" name="type" id="type" class="form-control input-mask" >
                                                        <option value="manager">Manager</option>
                                                        <option value="accountant">Accountant</option>
                                                        <option value="operator">Operator</option>
                                                        <option value="driver">Driver</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-4 mt-lg-0">
                                                <div class="form-group mb-4">
                                                    <label for="areas">Branches</label>

                                                    <select class="select2 form-control select2-multiple" multiple name="branches[]" id="areas">
                                                        @foreach($branches as $branch)
                                                            <option value="{{$branch->id}}">{{$branch->name_en}}</option>
                                                        @endforeach
                                                    </select>
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
