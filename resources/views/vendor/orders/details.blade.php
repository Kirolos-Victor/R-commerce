@extends('layouts.vendor')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Order Details</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Vendor Admin</a></li>
                                <li class="breadcrumb-item active">Order Details</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
    <!-- Modal -->
    <div class="card" >
            <div class="card-body">
                <div class="modal-header">
                    <h5 class="modal-title" >Order Details</h5>
                </div>
                <div class="modal-body">
                    <p class="mb-2">Order id: <span class="text-primary">#{{$order->id}}</span></p>
                    <p class="mb-4">Billing Name: <span class="text-primary">{{$order->user_name}}</span></p>

                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap">
                            <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->orderItems as $item)
                            <tr>
                                <td>
                                    <div>
                                        <h5 class="text-truncate font-size-14">{{$item->product_name}}</h5>
                                        @foreach($item->orderItemAddons as $itemAddon)
                                        <p class="text-muted mb-0">$  {{$itemAddon->addon_unit_price}} x  {{$itemAddon->addon_quantity}}</p>
                                        @endforeach
                                    </div>
                                </td>
                                @php
                                    $totalItemAddonPrice=0;
                                    $orderItemAddons=\App\Models\OrderItemAddon::where('order_item_id','=',$item->id)->get();
                                    foreach ($orderItemAddons as $orderItemAddon)
                                        {
                                            $totalItemAddonPrice=$totalItemAddonPrice+$orderItemAddon->addon_unit_price;

                                        }
                                    $totalItemPrice=0; $totalItemPrice=$item->unit_price*$item->quantity+$totalItemAddonPrice;

                                @endphp
                                <td>$ {{$totalItemPrice}}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="2">
                                    <h6 class="m-0 text-right">Total:</h6>
                                </td>
                                <td>
                                    $ {{$totalCartPrice}}
                                </td>
                            </tr>
                            
                            </tbody>
                        </table>
                        <div class="modal-header">
                            <h5 class="modal-title" >Addons</h5>
                        </div>


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
                                                        {{"* ".$detail->name_en}}      
                                                  </label>
                                                </div>
        
                                                @endif
        
                                        @endforeach
        
                                    @else
                                        @foreach($addon->addonDetails as $detail)
                                            <div class="form-check mt-3">
                                                    {{"* ".$detail->name_en}}                 
                                              </label>
                                            </div>
                                        @endforeach
                                        @endif
        
                                @empty
                                    No addons
        
                                @endforelse
        
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </div>
        </div>
    </div>
@endsection
