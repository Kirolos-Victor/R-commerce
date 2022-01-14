@extends('layouts.vendor')

@section('content')
    <!-- start page title -->
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row" style="margin-bottom: -40px;">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Cart</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Vendor Admin</a></li>
                                <li class="breadcrumb-item active">Cart</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
    <!-- end page title -->
    <div id="app">
    <vendor-cart route-create-orders="{{route('order.create')}}" route-cart-checkout="{{route('vendor-cart.checkout.form')}}" ></vendor-cart>
    <!-- end row -->
    </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/app.js') }}" defer></script>

@endsection
