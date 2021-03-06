@extends('layouts.vendor')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">{{__('Dashboard')}}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('Vendor')}} /
                                    {{__("Dashboard")}}</a></li>
                                <li class="breadcrumb-item active">{{__("Dashboard")}}</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-4">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-3">
                                        <h5 class="text-primary">{{__("Welcome Back ")}}!</h5>
                                        <p>Skote Dashboard</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="assets/images/profile-img.png" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <img src="assets/images/users/avatar-1.jpg" alt="" class="img-thumbnail rounded-circle">
                                    </div>
                                    <h5 class="font-size-15 text-truncate">Henry Price</h5>
                                    <p class="text-muted mb-0 text-truncate">UI/UX Designer</p>
                                </div>

                                <div class="col-sm-8">
                                    <div class="pt-4">

                                        <div class="row">
                                            <div class="col-6">
                                                <h5 class="font-size-15">125</h5>
                                                <p class="text-muted mb-0">{{__("Projects")}}</p>
                                            </div>
                                            <div class="col-6">
                                                <h5 class="font-size-15">$1245</h5>
                                                <p class="text-muted mb-0">{{__("Revenue")}}</p>
                                            </div>
                                        </div>
                                        <div class="mt-4">
                                            <a href="javascript: void(0);" class="btn btn-primary waves-effect waves-light btn-sm">{{__("View
                                                Profile")}} <i class="mdi mdi-arrow-right ms-1"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">{{__("Monthly Earning")}}</h4>
                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="text-muted">{{__("This month")}}</p>
                                    <h3>$34,252</h3>
                                    <p class="text-muted"><span class="text-success me-2"> 12% <i class="mdi mdi-arrow-up"></i> </span>
                                        {{__("From previous period")}}</p>

                                    <div class="mt-4">
                                        <a href="javascript: void(0);" class="btn btn-primary waves-effect waves-light btn-sm">{{__("View
                                            More")}} <i class="mdi mdi-arrow-right ms-1"></i></a>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mt-4 mt-sm-0">
                                        <div id="radialBar-chart" class="apex-charts"></div>
                                    </div>
                                </div>
                            </div>
                            <p class="text-muted mb-0">{{__("We craft digital, graphic and dimensional thinking.")}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">{{__("Orders")}}</p>
                                            <h4 class="mb-0">{{ $number }}</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                            <span class="avatar-title">
                                                                <i class="bx bx-copy-alt font-size-24"></i>
                                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">{{__("Revenue")}}</p>
                                            <h4 class="mb-0">$35, 723</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center ">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                            <span class="avatar-title rounded-circle bg-primary">
                                                                <i class="bx bx-archive-in font-size-24"></i>
                                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <p class="text-muted fw-medium">{{__("Average Price")}}</p>
                                            <h4 class="mb-0">$16.2</h4>
                                        </div>

                                        <div class="flex-shrink-0 align-self-center">
                                            <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                                            <span class="avatar-title rounded-circle bg-primary">
                                                                <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                                            </span>
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
                            <div class="d-sm-flex flex-wrap">
                                <h4 class="card-title mb-4">{{__("Orders")}}</h4>
                                <div class="ms-auto">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">{{__("Week")}}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">{{__("Month")}}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#">{{__("Year")}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div id="stacked-column-chart" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>

@endsection
