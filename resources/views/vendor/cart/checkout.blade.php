@extends('layouts.vendor')

@section('content')
    <div class="page-content" id="app">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Check Out</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Cart</a></li>
                                <li class="breadcrumb-item active">Check Out</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- start page title -->
            <check-out route-cart-checkout-submit="{{route('vendor-cart.checkout')}}"></check-out>


        </div>
    </div>
@endsection
@section('scripts')

    <script src="{{ asset('js/app.js') }}" defer></script>

@endsection
