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
                        <h4 class="mb-sm-0 font-size-18">Update User</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>

                                <li class="breadcrumb-item active">Update User</li>
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
                            <form action="{{route('users.update',$user->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div>
                                            <div class="form-group mb-4">
                                                <label for="first-name">First Name</label>
                                                <input id="first-name" class="form-control input-mask" type="text" name="first_name" value="{{$user->first_name}}" >
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-4 mt-lg-0">
                                            <div class="form-group mb-4">
                                                <label for="last-name">Last Name</label>
                                                <input type="text" name="last_name" id="last-name" class="form-control input-mask" value="{{$user->last_name}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-4 mt-lg-0">
                                            <div class="form-group mb-4">
                                                <label for="email">E-mail</label>
                                                <input type="email" name="email" id="email" class="form-control input-mask" value="{{$user->email}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-4 mt-lg-0">
                                            <div class="form-group mb-4">
                                                <label for="phone">Phone Number</label>
                                                <input type="text" name="phone" id="phone" class="form-control input-mask" value="{{$user->phone}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-4 mt-lg-0">
                                            <div class="form-group mb-4">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" id="password" class="form-control input-mask" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-4 mt-lg-0">
                                            <div class="form-group mb-4">
                                                <label for="password_confirmation">Password Confirmation</label>
                                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-mask" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-4 mt-lg-0">
                                            <div class="form-group mb-4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="active" name="active" {{$user->active == 1 ?'checked':''}}>
                                                    <label class="form-check-label" for="active">User Activation</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
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
