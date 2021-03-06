@extends('layouts.vendor')
@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Statistics</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Statistics</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">

                                    <div class="d-flex flex-wrap">
                                        <div class="me-3">
                                            <p class="text-muted mb-2">Total Sales Amount</p>
                                            <h5 class="mb-0">{{$totalSalesOrder}}</h5>
                                        </div>

                                        <div class="avatar-sm ms-auto">
                                            <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                                <i class="bx bxs-book-bookmark"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card blog-stats-wid">
                                <div class="card-body">

                                    <div class="d-flex flex-wrap">
                                        <div class="me-3">
                                            <p class="text-muted mb-2">Total Canceled Orders</p>
                                            <h5 class="mb-0">86</h5>
                                        </div>

                                        <div class="avatar-sm ms-auto">
                                            <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                                <i class="bx bxs-note"></i>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card blog-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap">
                                        <div class="me-3">
                                            <p class="text-muted mb-2">Total Delivered Orders</p>
                                            <h5 class="mb-0">{{\App\Models\Order::where('status','=','completed')->count()}}</h5>
                                        </div>

                                        <div class="avatar-sm ms-auto">
                                            <div class="avatar-title bg-light rounded-circle text-primary font-size-20">
                                                <i class="bx bxs-message-square-dots"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-wrap align-items-start">
                                <h5 class="card-title me-2">Visitors</h5>
                                <div class="ms-auto">
                                    <div class="toolbar button-items text-end">
                                        <button type="button" class="btn btn-light btn-sm">
                                            ALL
                                        </button>
                                        <button type="button" class="btn btn-light btn-sm">
                                            1M
                                        </button>
                                        <button type="button" class="btn btn-light btn-sm">
                                            6M
                                        </button>
                                        <button type="button" class="btn btn-light btn-sm active">
                                            1Y
                                        </button>

                                    </div>
                                </div>
                            </div>

                            <div class="row text-center">
                                <div class="col-lg-4">
                                    <div class="mt-4">
                                        <p class="text-muted mb-1">Today</p>
                                        <h5>1024</h5>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mt-4">
                                        <p class="text-muted mb-1">This Month</p>
                                        <h5>12356 <span class="text-success font-size-13">0.2 % <i class="mdi mdi-arrow-up ms-1"></i></span></h5>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mt-4">
                                        <p class="text-muted mb-1">This Year</p>
                                        <h5>102354 <span class="text-success font-size-13">0.1 % <i class="mdi mdi-arrow-up ms-1"></i></span></h5>
                                    </div>
                                </div>
                            </div>

                            <hr class="mb-4">

                            <div class="apex-charts" id="area-chart" dir="ltr"></div>
                        </div>
                    </div>

                <!-- end col -->
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-wrap align-items-start">
                                <h5 class="card-title me-2 mb-4">Top Selling Items</h5>
                            </div>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Item</th>
                                        <th>Sold Quantity</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($topSellingItems as $key => $value)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{\App\Models\Product::where('id','=',$key)->value('name_en')}}</td>
                                            <td>{{$value}}</td>

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-wrap align-items-start">
                                <h5 class="card-title me-2 mb-4">Most ordered Location</h5>
                            </div>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Area</th>
                                        <th>Occurrences</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

@endsection
