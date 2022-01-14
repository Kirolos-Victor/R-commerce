@extends('layouts.vendor')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@section('content')
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
    <div >
        <div class="col-lg-12">
            <div class="card">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
    <div class="card-body">
        <form action="{{route('addToCart',$product->id)}}" method="POST" >

            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="mt-4 mt-lg-0">
                        <div class="form-group mb-4">
                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner" role="listbox">

                                    @foreach($images as $image)
                                        <div class="carousel-item {{$loop->index == 0?'active':''}}">
                                            <img class="d-block img-fluid" src="{{asset($image->image)}}" alt="{{$image->id}}" style="width: 100%; height: 400px;">
                                        </div>
                                    @endforeach
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div>
                        <div class="form-group mb-4">
                            <label for="english-name">Name</label>

                            <input id="english-name" class="form-control input-mask" type="text"  value="{{$product->name_en}}" disabled>
                        </div>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div>
                        <div class="form-group mb-4">
                            <label for="english-description">Description</label>
                            <input id="english-description" class="form-control input-mask"  value="{{$product->description_en}}" disabled>
                        </div>

                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="mt-4 mt-lg-0">
                        <div class="form-group mb-4">
                            <label for="amount">Amount</label>
                            <input type="text" name="amount" id="amount" class="form-control input-mask" value="1">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mt-4 mt-lg-0">
                        <div class="form-group mb-4">
                            <label for="price">Price</label>
                            <input type="text"  id="price" class="form-control input-mask" value="{{$product->price}}" disabled>
                        </div>
                    </div>
                </div>
                <h2>Addons</h2>


                <div class="col-lg-6">
                    <div class="mt-4 mb-5 mt-lg-0">
                        @forelse($product->addons as $addon)
                            <h4 class="mt-3">{{$loop->index+1 ."-". $addon->name_en}}</h4>

                            @if($addon->must_select ==1)
                                @foreach($addon->addonDetails as $detail)
                                    @if($addon->quantity_meter == 1)

                                        <div class="mt-3" ><label >{{"*  ". $detail->name_en}}</label>
                                            <input type="hidden" name="addonDetails_id[]" value="{{$detail->id}}">
                                            <input type="hidden" name="addon_id" value="{{$addon->id}}">

                                            <div class="col-sm-4 col-sm-offset-4">
                                                <div class="input-group mb-3">
                                                        <button type="button" class="btn btn-dark btn-sm minus-btn" ><i class="fa fa-minus"></i></button>
                                                    <input type="number"  class="form-control form-control-sm qty_input" name="addonDetails_quantity[]" value="1" min="1" >
                                                    <input type="hidden" class="maximum_quantity_input" value="{{$addon->quantity}}">
                                                        <button type="button" class="btn btn-dark btn-sm plus-btn"  ><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>

                                    @else
                                        <div class="form-check mt-3">
                                            <input class="form-check-input" type="checkbox" name="addonDetailsCheckbox_id[]" value="{{$detail->id}}" id="{{'flexCheckDefault'.$detail->id}}">
                                            <label class="form-check-label" for="{{'flexCheckDefault'.$detail->id}}">
                                                {{$detail->name_en}}                                            </label>
                                        </div>

                                        @endif

                                @endforeach

                            @else
                                @foreach($addon->addonDetails as $detail)
                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="radio" name="addonDetailsRadioButton_id[{{$addon->id}}][]" value="{{$detail->id}}" id="{{'flexRadioDefault'.$detail->id}}">
                                        <label class="form-check-label" for="{{'flexRadioDefault'.$detail->id}}">
                                            {{$detail->name_en}}                                             </label>
                                    </div>
                                @endforeach
                                @endif

                        @empty
                            No addons

                        @endforelse

                    </div>
                </div>


            </div>
            <button type="submit" class="btn btn-primary mt-2">Add to cart</button>
        </form>
    </div>
            </div></div></div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('.plus-btn').click(function(){
              var inputValue= $(this).siblings('.qty_input').val();
                $(this).siblings('.qty_input').val(parseInt(inputValue) + 1);
                var sum = 0;
                $(".qty_input").each(function(){
                    sum += +$(this).val();
                });

                if(sum == $('.maximum_quantity_input').val()){

                    $('.plus-btn').hide();
                }
            });
            $('.minus-btn').click(function(){
                var inputValue= $(this).siblings('.qty_input').val();
                $(this).siblings('.qty_input').val(parseInt(inputValue) - 1);
                $('.plus-btn').show();

                if ($('.qty_input').val() == 0) {
                    $('.qty_input').val(1);
                }

            });
        });
    </script>
@endsection
