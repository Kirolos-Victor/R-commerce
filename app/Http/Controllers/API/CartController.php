<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\DeliveryZoneArea;
use App\Models\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $userId = auth('sanctum')->user()->id . "user";

        $cart = \Cart::session($userId)->getContent();
        if ($cart->isNotEmpty()) {
            $totalPayment = 0;
            foreach ($cart as $item) {
                $totalPayment = $totalPayment + ($item->price * $item->quantity);
            }
            $cart['subTotal'] = $totalPayment;

            $cart['totalPayment'] = $totalPayment;
            return responseJson(200, 'success', $cart);
        } else {
            return responseJson(404, 'Cart is empty');
        }
    }

    public function create(Request $request, $id)
    {
        $validator = Validator()->make($request->all(), [
            'quantity' => 'required',
        ]);
        if ($validator->fails()) {
            return responseJson(400, 'failed', $validator->errors());
        }

        $userId = auth('sanctum')->user()->id . "user";

        $oldCart = \Cart::session($userId)->getContent();
        $product = Product::findorfail($id);
        //dd($product->vendor_id);

        if ($oldCart->isNotEmpty()) {
            foreach ($oldCart as $item) {
                if ($item->attributes['vendor_id'] != $product->vendor_id) {
                    return responseJson(400, 'Sorry, you can not purchase from another vendor at the sametime');
                }
            }
        }
        \Cart::session($userId)->add(array(
            'id' => $product->id,
            'name' => $product->name_en,
            'price' => $product->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'vendor_id' => $product->vendor_id
            ),
            'associatedModel' => auth('sanctum')->user(),
        ));

        return responseJson(200, 'success');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator()->make($request->all(), [
            'quantity' => 'required',
        ]);
        if ($validator->fails()) {
            return responseJson(400, 'failed', $validator->errors());
        }
        $userId = Auth('sanctum')->user()->id . "user";
        \Cart::session($userId)->remove($id);

        $product = Product::findorfail($id);
        \Cart::session($userId)->add(array(
            'id' => $product->id,
            'name' => $product->name_en,
            'price' => $product->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'vendor_id' => $product->vendor_id
            ),
            'associatedModel' => auth('sanctum')->user(),
        ));
        return responseJson(200, 'success');
    }

    public function destroy($id)
    {
        $userId = Auth()->user()->id . "user";

        \Cart::session($userId)->remove($id);
        return responseJson(200, 'success');
    }

    public function checkout(Request $request)
    {
        $rules = ['payment_method' => 'required', 'zone_id' => 'required'];
        if (!auth('sanctum')->check()) {
            $rules += ['address' => 'required'];
        }
        $validator = Validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return responseJson(400, 'failed', $validator->errors());
        }
        $deliveryTime = Delivery::where('id', '=', $request->zone_id)->first();
        return responseJson(200, 'success', $deliveryTime);
    }
}
