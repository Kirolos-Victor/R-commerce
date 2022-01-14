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
                        <h4 class="mb-sm-0 font-size-18">Update Vendor Admin</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                <li class="breadcrumb-item active">Update Vendor Admin</li>
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
                            <form action="{{route('ads.update',$ads->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div>
                                            <div class="form-group mb-4">
                                                <label for="title">Title</label>
                                                <input id="title" class="form-control input-mask" type="text" name="title" value="{{$ads->title}}">
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-4 mt-lg-0">
                                            <div class="form-group mb-4">
                                                <label for="image">Image</label>
                                                <input type="file" name="image" id="image" class="form-control input-mask">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mt-4 mt-lg-0">
                                            <div class="form-group mb-4">
                                                <label for="vendor">Select Vendor</label>
                                                <select name="vendor_id" id="vendor" class="form-control input-mask" >
                                                    @foreach($vendors as $vendor)
                                                        @if($ads->vendor_id === $vendor->id)
                                                        <option value="{{$vendor->id}}" selected>{{$vendor->name_en}}</option>
                                                        @else
                                                            <option value="{{$vendor->id}}" >{{$vendor->name_en}}</option>
                                                        @endif

                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mt-4 mt-lg-0">
                                            <div class="form-group mb-4">
                                                <label for="type">Select Type</label>
                                                <select type="text" name="type" id="type" class="form-control input-mask" >
                                                    @if($ads->type === 'flowers')

                                                        <option value="flowers" selected>Flowers</option>
                                                        <option value="perfumes">Perfumes</option>
                                                        <option value="chocolates">Chocolate</option>
                                                    @elseif($ads->type==='perfumes')
                                                        <option value="flowers">Flowers</option>
                                                        <option value="perfumes" selected>Perfumes</option>
                                                        <option value="chocolates">Chocolate</option>
                                                    @else
                                                        <option value="flowers">Flowers</option>
                                                        <option value="perfumes">Perfumes</option>
                                                        <option value="chocolates" selected>Chocolate</option>
                                                        @endif
                                                </select>
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
