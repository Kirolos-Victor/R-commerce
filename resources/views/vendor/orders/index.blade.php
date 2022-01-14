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
                        <h4 class="mb-sm-0 font-size-18">Orders</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Vendor Admin</a></li>
                                <li class="breadcrumb-item active">Orders</li>
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
                        @if(\Illuminate\Support\Facades\Request::has('create-success'))
                            <div class="alert alert-success">
                                The order created successfully
                            </div>
                            @endif

                            <div class="card-body">
                                <a class="btn btn-primary mb-2"  href="{{route('order.create')}}">Create Order</a>

                                <ul class="nav nav-tabs nav-tabs-custom nav-justified" >
                                    <li class="nav-item">
                                        <a class="nav-link {{\Illuminate\Support\Facades\Request::fullUrl() === url('en/vendor/orders?status=all')?'active':''}} {{ \Illuminate\Support\Facades\Request::fullUrl() === url('/vendor/orders')?'active':''}}" href="{{url('/vendor/orders?status=all')}}" >
                                            <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                            <span class="d-none d-sm-block">All({{\App\Models\Order::count()}}) </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{\Illuminate\Support\Facades\Request::fullUrl() === url('en/vendor/orders?status=pending')?'active':''}}"  href="{{url('/vendor/orders?status=pending')}}" >
                                            <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                            <span class="d-none d-sm-block">Pending({{\App\Models\Order::where('status','=','pending')->count()}})</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{\Illuminate\Support\Facades\Request::fullUrl() === url('en/vendor/orders?status=in-progress')?'active':''}}" href="{{url('/vendor/orders?status=in-progress')}}" >
                                            <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                            <span class="d-none d-sm-block">In Progress({{\App\Models\Order::where('status','=','in-progress')->count()}})</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{\Illuminate\Support\Facades\Request::fullUrl() === url('en/vendor/orders?status=shipped')?'active':''}}"  href="{{url('/vendor/orders?status=shipped')}}" >
                                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                            <span class="d-none d-sm-block">Shipped({{\App\Models\Order::where('status','=','shipped')->count()}})</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{\Illuminate\Support\Facades\Request::fullUrl() === url('en/vendor/orders?status=completed')?'active':''}}"  href="{{url('/vendor/orders?status=completed')}}" >
                                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                            <span class="d-none d-sm-block">Completed({{\App\Models\Order::where('status','=','completed')->count()}})</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{\Illuminate\Support\Facades\Request::fullUrl() === url('en/vendor/orders?status=canceled')?'active':''}}"  href="{{url('/vendor/orders?status=canceled')}}" >
                                            <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                            <span class="d-none d-sm-block">Canceled({{\App\Models\Order::where('status','=','canceled')->count()}})</span>
                                        </a>
                                    </li>
                                </ul>

                            </div>

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
                                        <th>Receipt</th>
                                        <th>Order Details</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->user_name}}</td>
                                        <td>{{$order->order_code}}</td>
                                        <td class="w-25">
                                           <form action="{{route('order.update',$order->id)}}" method="POST">
                                               @csrf
                                               @method('PUT')
                                               <select name="status" onchange="this.form.submit()" class="form-control">
                                                   @if($order->status =='pending')
                                                       <option value="pending" selected>Pending</option>
                                                       <option value="in-progress">In Progress</option>
                                                       <option value="shipped">Shipped</option>
                                                       <option value="completed">Completed</option>
                                                       <option value="canceled">Canceled</option>
                                                       @elseif($order->status =='in-progress')
                                                       <option value="pending">Pending</option>
                                                       <option value="in-progress" selected>In Progress</option>
                                                       <option value="shipped">Shipped</option>
                                                       <option value="completed">Completed</option>
                                                       <option value="canceled">Canceled</option>
                                                   @elseif($order->status== 'shipped')
                                                       <option value="pending">Pending</option>
                                                       <option value="in-progress">In Progress</option>
                                                       <option value="shipped" selected>Shipped</option>
                                                       <option value="completed">Completed</option>
                                                       <option value="canceled">Canceled</option>

                                                   @elseif($order->status=='completed')
                                                       <option value="pending">Pending</option>
                                                       <option value="in-progress">In Progress</option>
                                                       <option value="shipped">Shipped</option>
                                                       <option value="completed" selected>Completed</option>
                                                       <option value="canceled">Canceled</option>
                                                   @else
                                                       <option value="pending">Pending</option>
                                                       <option value="in-progress">In Progress</option>
                                                       <option value="shipped">Shipped</option>
                                                       <option value="completed" >Completed</option>
                                                       <option value="canceled" selected>Canceled</option>
                                                   @endif

                                               </select>
                                           </form>
                                        </td>
                                        <td>{{$order->shipping_address}}</td>
                                        <td>{{$order->total}}</td>
                                        <td>{{$order->sub_total}}</td>
                                        <td>{{$order->total_discount}}</td>
                                        <td>{{$order->delivery_charges}}</td>
                                        <td>{{$order->payment_method}}</td>
                                        <td><a href="{{route('receipt.index',$order->id)}}" class="btn btn-primary">View</a></td>
                                        <td><a href="{{route('vendor.orderDetail',$order->id)}}" class="btn btn-secondary">Order Details</a></td>

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
@section('scripts')
    <script>
        $('.deleteModal').on('click',function (e) {
            e.preventDefault();
            var form = e.target.form; // storing the form
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    form.submit();
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        })
    </script>
@endsection
