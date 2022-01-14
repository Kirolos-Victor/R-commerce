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
                            <h4 class="mb-sm-0 font-size-18">Receipt</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Orders</a></li>
                                    <li class="breadcrumb-item active">Receipt</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="invoice-title">
                                    <h4 class="float-end font-size-16">Order # {{$order->id}}</h4>
                                    <div class="mb-4">
                                        <img src="{{asset('/assets/images/logo/LogoC.jpg')}}" alt="logo" height="50"/>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <address>
                                            <strong>Billed To:</strong><br>
                                            {{$order->user_name}}<br>

                                        </address>
                                    </div>
                                    <div class="col-sm-6 text-sm-end">
                                        <address class="mt-2 mt-sm-0">
                                            <strong>Shipped To:</strong><br>

                                            {{$order->shipping_address}}
                                        </address>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mt-3">
                                        <address>
                                            <strong>Payment Method:</strong><br>
                                            {{$order->payment_method}}<br>
                                        </address>
                                    </div>
                                    <div class="col-sm-6 mt-3 text-sm-end">
                                        <address>
                                            <strong>Order Date:</strong><br>
                                            {{$order->created_at}}<br><br>
                                        </address>
                                    </div>
                                </div>
                                <div class="py-2 mt-3">
                                    <h3 class="font-size-15 fw-bold">Order summary</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-nowrap">
                                        <thead>
                                        <tr>
                                            <th style="width: 70px;">No.</th>
                                            <th>Item</th>
                                            <th>Quantity</th>
                                            <th>Item Price</th>
                                            <th class="text-end">Total Price</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order->orderItems as $item)

                                            <tr>
                                                <td>{{$loop->index +1}}</td>
                                                <td>{{$item->product_name}} <p style="font-size: 10px">
                                                        @foreach($item->orderItemAddons as $itemAddons)

                                                        <p class="text-muted mb-0">{{$itemAddons->addon->name_en}} x {{$itemAddons->addon_quantity}}</p>

                                                        @endforeach
                                                    </p></td>
                                                <td>{{$item->quantity}}</td>
                                                <td>{{$item->unit_price}}</td>
                                                @php
                                                    $totalItemAddonPrice=0;
                                                    $orderItemAddons=\App\Models\OrderItemAddon::where('order_item_id','=',$item->id)->get();
                                                    foreach ($orderItemAddons as $orderItemAddon)
                                                        {
                                                            $totalItemAddonPrice=$totalItemAddonPrice+$orderItemAddon->addon_unit_price;

                                                        }
                                                    $totalItemPrice=0; $totalItemPrice=$item->unit_price*$item->quantity+$totalItemAddonPrice;

                                                @endphp

                                                <td class="text-end">${{$totalItemPrice}}</td>

                                            </tr>
                                        @endforeach

                                        <tr>
                                            <td colspan="4" class="border-0 text-end">
                                                <strong>Total</strong></td>
                                            @if(!empty($totalCartPrice))
                                            <td class="border-0 text-end"><h4 class="m-0">${{$totalCartPrice}}</h4></td>
                                            @else
                                                <td class="border-0 text-end"><h4 class="m-0">$0</h4></td>
                                                @endif

                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-print-none">
                                    <div class="float-end">
                                        <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                                        <a href="{{route('thermal-print',$order->id)}}" class="btn btn-primary w-md waves-effect waves-light">Thermal Print</a>
                                    </div>
                                </div>
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
