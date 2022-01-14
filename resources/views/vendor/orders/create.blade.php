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
                        <h4 class="mb-sm-0 font-size-18">Create Order</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li><a href="{{route('vendor-cart.index')}}" class="btn btn-primary" style="margin-right: 20px;">My Cart ({{$itemsCount}})</a></li>

                                <li class="breadcrumb-item"><a href="javascript: void(0);">Vendor Admin</a></li>
                                <li class="breadcrumb-item active">Create Order</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

                    <div class="card">
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <th>{{$product->id}}</th>

                                        <td>{{$product->name_en}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>
                                            <div class="row">


                                                <a class="w-50 col-6 btn btn-primary" href="{{route('order.item',$product->id)}}" >Purchase</a>

                                                </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                            <div class="d-flex justify-content-between align-items-center flex-wrap" style="position: relative;top: 0;bottom: 0;left: 0; right: 0; width: 200px; height: 100px; margin: auto;">
                                <div class="d-flex flex-wrap mr-3">

                                    {{$products->links('vendor.pagination.custom')}}

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
