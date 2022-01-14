@extends('layouts.vendor')
@section('content')
    <!-- end page title -->

    <div class="row mb-3" style="margin-top: 100px;">
        <div class="col-12">
            <div class="card">
                @isset($paymentSetting)
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                <form action="{{route('payment-settings.update',$paymentSetting->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                <div class="card-body">

                    <h3 class="card-title mb-3">Payment Settings</h3>


                    <div class="mb-3 row">

                        <label for="cash_on_delivery" class="col-md-2 col-form-label">Cash On Delivery</label>
                        <div class="col-md-10 mt-2">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="cash_on_delivery" name="cash_on_delivery" value="1" {{$paymentSetting->cash_on_delivery == 1?'checked':''}}>
                            </div>

                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="knet" class="col-md-2 col-form-label">KNet</label>
                        <div class="col-md-10">
                            <div class="col-md-10 mt-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="knet" value="1" name="knet" {{$paymentSetting->knet == 1?'checked':''}}>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="visa" class="col-md-2 col-form-label">Visa</label>
                        <div class="col-md-10">
                            <div class="col-md-10 mt-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="visa" value="1" name="visa" {{$paymentSetting->visa == 1?'checked':''}}>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                    <button class="btn btn-primary " style="margin-bottom: 50px;margin-left: 10px;">Update</button>

                </form>

                @endisset

            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection
