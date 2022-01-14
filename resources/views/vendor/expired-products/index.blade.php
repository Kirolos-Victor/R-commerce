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
                        <h4 class="mb-sm-0 font-size-18">Expired Stock</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Vendor Admin</a></li>
                                <li class="breadcrumb-item active">Expired Stock</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

                    <div class="card">
                        @if(\Illuminate\Support\Facades\Request::has('create-success'))
                            <div class="alert alert-success">
                               You have created the product Successfully
                            </div>
                            @endif
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <div class="card-body">
{{--                            <a class="btn btn-primary mb-3" href="{{route('products.create')}}">Create Product</a>--}}

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Product Description</th>
                                        <th>Product Price</th>
                                        <th>Product Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($expiredProducts as $product)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td ><div style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; width: 150px;">{{$product->name_en}}</div></td>
                                        <td><div style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap; width: 150px;">{{$product->description_en}}</div></td>
                                        <td>{{$product->price}}</td>
                                        <td class="text-danger">{{$product->amount}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                            <div class="d-flex justify-content-between align-items-center flex-wrap" style="position: relative;top: 0;bottom: 0;left: 0; right: 0; width: 200px; height: 100px; margin: auto;">
                                <div class="d-flex flex-wrap mr-3">

                                    {{$expiredProducts->links('vendor.pagination.custom')}}

                                </div>
                            </div>
                    </div>
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
