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
                        <h4 class="mb-sm-0 font-size-18">Orders</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>

                                <li class="breadcrumb-item active">Orders</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="card">

                <div class="table-responsive">
                    <table class="table mb-0">

                        <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>User Name</th>
                            <th>Order Code</th>
                            <th>Status</th>
                            <th>Shipping Address</th>
                            <th>Total</th>
                            <th>Sub Total</th>
                            <th>Total Discount</th>
                            <th>Delivery Charges</th>
                            <th>Payment Method</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$order->user_name}}</td>
                                <td>{{$order->order_code}}</td>
                                <td>{{$order->status}}</td>
                                <td>{{$order->shipping_address}}</td>
                                <td>{{$order->total}}</td>
                                <td>{{$order->sub_total}}</td>
                                <td>{{$order->total_discount}}</td>
                                <td>{{$order->delivery_charges}}</td>
                                <td>{{$order->payment_method}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="d-flex justify-content-between align-items-center flex-wrap" style="position: relative;top: 0;bottom: 0;left: 0; right: 0; width: 200px; height: 100px; margin: auto;">
                <div class="d-flex flex-wrap mr-3">

                    {{$orders->links('vendor.pagination.custom')}}

                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
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
