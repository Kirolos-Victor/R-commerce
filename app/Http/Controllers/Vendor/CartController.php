<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Mail\OrderCreated;
use App\Models\AddonSectionDetail;
use App\Models\Area;
use App\Models\Branch;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{

    public function index(Request $request){
        $items = \Cart::session(Auth('vendor')->user()->id)->getContent();
//        dd($items);
        $totalAddonPrice=0;
        $totalProductPrice=0;

        foreach ($items as $item)
        {
          $totalAddonPrice=$totalAddonPrice+$item->attributes['totalAddonPrice'];
            $totalProductPrice=$totalProductPrice+$item->attributes['totalProductPrice'];

        }

        $totalCartPrice=$totalProductPrice;

        if($request->ajax())
        {
            return response()->json(['items'=>$items,'totalCartPrice'=>$totalCartPrice]);
        }
        return view('vendor.cart.index');
    }
    public function productAmount($id)
    {
        $productAmount=Product::findorfail($id)->value('amount');
        return response()->json($productAmount);
    }

    public function update(Request $request,$id){
        //dd($request['quantity']);
        $userID=Auth('vendor')->user()->id;
        $oldProduct=\Cart::session($userID)->get($id);
        \Cart::session(Auth('vendor')->user()->id)->remove($id);
        $oldAddonPrice=$oldProduct->attributes->totalAddonPrice / $oldProduct->quantity;
        $totalAddonPrice=$oldAddonPrice * $request['quantity'];

        $totalProductPrice=$oldProduct->price*$request['quantity']+$totalAddonPrice;
//        $addonDetailsIds_Quantities=[];
//        foreach ($oldProduct->attributes->addonDetailsIds_Quantities as $key => $value)
//        {
//            $addonDetailsIds_Quantities[$key]=$request['quantity'];
//        }

        \Cart::session($userID)->add(array(
            'id' => $id,
            'name' => $oldProduct->name,
            'price' => $oldProduct->price,
            'quantity' => $request['quantity'],
            'attributes' => array(
                'totalAddonPrice'=>$totalAddonPrice,
                'totalProductPrice'=>$totalProductPrice,
                'addonDetailsIds_Quantities'=>$oldProduct->attributes->addonDetailsIds_Quantities,
                'product_id'=>$oldProduct->attributes->product_id,
                'product_name'=>$oldProduct->attributes->product_name,

            )
        ));
        return response()->json(\Cart::session($userID)->get($id));


    }
    public function destroy($id)
    {
        \Cart::session(Auth('vendor')->user()->id)->remove($id);


    }
    public function addonDetail($id){
        $data=AddonSectionDetail::findorfail($id);
        return response()->json($data);

    }
    public function branches(){
        $data=Branch::where('vendor_id','=',Auth('vendor')->user()->vendor_id)->get();
        return response()->json($data);
    }
    public function areas(){
        $data=Area::all();
        return response()->json($data);
    }

    public function checkoutForm(Request $request){
        $users=User::all();


        return view('vendor.cart.checkout',compact('users'));

    }
    public function checkout(CheckoutRequest $request){
        $items = \Cart::session(Auth('vendor')->user()->id)->getContent();
        $totalAddonPrice=0;
        $totalProductPrice=0;

        foreach ($items as $item)
        {
            $totalAddonPrice=$totalAddonPrice+$item->attributes['totalAddonPrice'];
            $totalProductPrice=$totalProductPrice+$item->attributes['totalProductPrice'];
        }

        $totalCartPrice=$totalProductPrice;
        $vendor=Auth('vendor')->user();

        Order::create([
            'vendor_id'=>$vendor->vendor_id,
            'status'=>'pending',
            'total'=>$totalCartPrice,
            'order_code'=>rand(100,1000),
            'shipping_address'=>'RANDOM',
            'payment_method'=>'cash_on_delivery',
            'sub_total'=>$totalCartPrice,
            'total_discount'=>0,
            'delivery_charges'=>0,
            'created_month'=>Carbon::now()->format('Y-m'),
            'user_name'=>$request->name,
            'phone'=>$request->phone,
            'order_type'=>$request->orderType,
            'branch_id'=>$request->branch_id,
            'area_id'=>$request->area_id,
            'payment_status'=>'pending'


        ]);
        Mail::to($vendor->email)->send(new OrderCreated($vendor));
        return response()->json('done');


    }

}
