<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderItemRquest;
use App\Models\AddonSection;
use App\Models\AddonSectionDetail;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if (Auth('vendor')->user()->type == 'driver') {
            $orders = Order::where('status', '=', 'shipped')->paginate(10);

        } elseif ($request->status == 'all' or !$request->status) {
            $orders = Order::paginate(10);

        } else {
            $orders = Order::where('status', '=', $request->status)->paginate(10);
        }

        return view('vendor.orders.index', compact('orders'));
    }

    public function create()

    {
        $products = Product::where('vendor_id', '=', Auth('vendor')->user()->vendor_id)->paginate(10);
        $itemsCount = \Cart::session(Auth('vendor')->user()->id)->getContent()->count();
        return view('vendor.orders.create', compact('products', 'itemsCount'));
    }

    public function item($id)
    {
        $product = Product::with('addons', 'addons.addonDetails')->findorfail($id);
        $images = ProductImage::where('product_id', '=', $id)->get();
        return view('vendor.orders.item', compact('product', 'images'));
    }

    public function orderItem(OrderItemRquest $request, $id)
    {
        //custom validation
         $productAmount=Product::findorfail($id)->value('amount');
        if($request->amount > $productAmount)
        {
            return redirect()->back()->withErrors('Product maximum amount is  ' . $productAmount);
        }

        if ($request->has('addonDetails_quantity')) {
            $totalQuantity = 0;
            $addonQuantities = $request->addonDetails_quantity;
            $addon = AddonSection::findorfail($request->addon_id);
            foreach ($addonQuantities as $addonQuantity) {
                $totalQuantity = $totalQuantity + $addonQuantity;
            }
            if ($totalQuantity > $addon->quantity) {
                return redirect()->back()->withErrors('Addons maximum quantity is  ' . $addon->quantity);
            }

        }

        $addonDetailsRadioButton_id = $request->addonDetailsRadioButton_id;

        $addonDetailsCheckbox_id = $request->addonDetailsCheckbox_id;

        $addonDetailsIds_Quantities = [];
        $userID = Auth('vendor')->user()->id;
        $uniqueProductId = $id;


        if ($request->has('addonDetails_id') && $request->has('addonDetails_quantity') && $request->has('addonDetailsRadioButton_id') && $request->has('addonDetailsCheckbox_id')) {
            $i = 0;
            $uniqueProductId = $id . implode('', $request->addonDetails_id) . implode('', array_column($request->addonDetailsRadioButton_id, 0)) . implode('', $request->addonDetailsCheckbox_id);
            $oldCart = \Cart::session($userID)->get($uniqueProductId);

            $addonDetailsId = $request->addonDetails_id;
            $addonDetailsQuantity = $request->addonDetails_quantity;
            //dd($addonDetailsQuantity);
            if (!empty($oldCart)) {
                foreach ($oldCart->attributes['addonDetailsIds_Quantities'] as $key => $value) {
                    $addonDetailsIds_Quantities[$key] = $value;
                }
                while ($i < count($addonDetailsId)) {
                    $addonDetail = AddonSectionDetail::findorfail($addonDetailsId[$i]);
                    if (array_key_exists($addonDetailsId[$i], $oldCart->attributes['addonDetailsIds_Quantities'])) {
                        $addonDetailsIds_Quantities[$addonDetail->id] = ($addonDetailsQuantity[$i] + $oldCart->attributes['addonDetailsIds_Quantities'][$addonDetailsId[$i]]) * $request->amount;
                    }

                    $i++;
                }
                foreach ($addonDetailsRadioButton_id as $addonDetailRadioButton_id) {
                    if (array_key_exists($addonDetailRadioButton_id[0], $oldCart->attributes['addonDetailsIds_Quantities'])) {
                        $addonDetailsIds_Quantities[$addonDetailRadioButton_id[0]] = $request->amount + $oldCart->attributes['addonDetailsIds_Quantities'][$addonDetailRadioButton_id[0]];

                    } else {
                        $addonDetailsIds_Quantities[$addonDetailRadioButton_id[0]] = $request->amount;
                    }
                }
                foreach ($addonDetailsCheckbox_id as $addonDetailCheckbox_id) {
                    if (array_key_exists($addonDetailCheckbox_id, $oldCart->attributes['addonDetailsIds_Quantities'])) {
                        $addonDetailsIds_Quantities[$addonDetailCheckbox_id] = $request->amount + $oldCart->attributes['addonDetailsIds_Quantities'][$addonDetailCheckbox_id];

                    } else {
                        $addonDetailsIds_Quantities[$addonDetailCheckbox_id] = $request->amount;
                    }
                }
            }

        } elseif ($request->has('addonDetails_id') && $request->has('addonDetails_quantity') && $request->has('addonDetailsRadioButton_id')) {
            $i = 0;
            $addonDetailsId = $request->addonDetails_id;
            $addonDetailsQuantity = $request->addonDetails_quantity;
            $addonDetailsRadioButton_id = $request->addonDetailsRadioButton_id;

            $uniqueProductId = $id . implode('', $request->addonDetails_id) . implode('', array_column($request->addonDetailsRadioButton_id, 0));
            $oldCart = \Cart::session($userID)->get($uniqueProductId);
            if (!empty($oldCart)) {
                foreach ($oldCart->attributes['addonDetailsIds_Quantities'] as $key => $value) {
                    $addonDetailsIds_Quantities[$key] = $value;
                }
                while ($i < count($addonDetailsId)) {
                    $addonDetail = AddonSectionDetail::findorfail($addonDetailsId[$i]);
                    if (array_key_exists($addonDetailsId[$i], $oldCart->attributes['addonDetailsIds_Quantities'])) {
                        $addonDetailsIds_Quantities[$addonDetail->id] = ($addonDetailsQuantity[$i] + $oldCart->attributes['addonDetailsIds_Quantities'][$addonDetailsId[$i]]) * $request->amount;
                    }

                    $i++;
                }
                foreach ($addonDetailsRadioButton_id as $addonDetailRadioButton_id) {
                    if (array_key_exists($addonDetailRadioButton_id[0], $oldCart->attributes['addonDetailsIds_Quantities'])) {
                        $addonDetailsIds_Quantities[$addonDetailRadioButton_id[0]] = $request->amount + $oldCart->attributes['addonDetailsIds_Quantities'][$addonDetailRadioButton_id[0]];

                    } else {
                        $addonDetailsIds_Quantities[$addonDetailRadioButton_id[0]] = $request->amount;
                    }
                }
            } else {
                foreach ($addonDetailsRadioButton_id as $addonDetailRadioButton_id) {
                    $addonDetailsIds_Quantities[$addonDetailRadioButton_id[0]] = $request->amount;
                }
                while ($i < count($addonDetailsId)) {
                    $addonDetail = AddonSectionDetail::findorfail($addonDetailsId[$i]);
                    if (array_key_exists($i, $addonDetailsQuantity)) {
                        $addonDetailsIds_Quantities[$addonDetail->id] = $addonDetailsQuantity[$i];
                    }

                    $i++;
                }
            }


        } elseif ($request->has('addonDetails_id') && $request->has('addonDetails_quantity') && $request->has('addonDetailsCheckbox_id')) {
            $uniqueProductId = $id . implode('', $request->addonDetails_id) . implode('', $request->addonDetailsCheckbox_id
                );
            $oldCart = \Cart::session($userID)->get($uniqueProductId);
            $i = 0;
            $addonDetailsQuantity = $request->addonDetails_quantity;
            $addonDetailsId = $request->addonDetails_id;
            if (!empty($oldCart)) {
                foreach ($oldCart->attributes['addonDetailsIds_Quantities'] as $key => $value) {
                    $addonDetailsIds_Quantities[$key] = $value;
                }
                while ($i < count($addonDetailsId)) {
                    $addonDetail = AddonSectionDetail::findorfail($addonDetailsId[$i]);
                    if (array_key_exists($addonDetailsId[$i], $oldCart->attributes['addonDetailsIds_Quantities'])) {
                        $addonDetailsIds_Quantities[$addonDetail->id] = ($addonDetailsQuantity[$i] + $oldCart->attributes['addonDetailsIds_Quantities'][$addonDetailsId[$i]]) * $request->amount;
                    }

                    $i++;
                }
                foreach ($addonDetailsCheckbox_id as $addonDetailCheckbox_id) {
                    if (array_key_exists($addonDetailCheckbox_id, $oldCart->attributes['addonDetailsIds_Quantities'])) {
                        $addonDetailsIds_Quantities[$addonDetailCheckbox_id] = $request->amount + $oldCart->attributes['addonDetailsIds_Quantities'][$addonDetailCheckbox_id];

                    } else {
                        $addonDetailsIds_Quantities[$addonDetailCheckbox_id] = $request->amount;
                    }
                }
            } else {
                foreach ($addonDetailsCheckbox_id as $addonDetailCheckbox_id) {
                    // dd($addonDetailCheckbox_id);

                    $addonDetailsIds_Quantities[$addonDetailCheckbox_id] = $request->amount;
                }
            }


        } elseif ($request->has('addonDetails_quantity') && $request->has('addonDetailsCheckbox_id')) {
            $uniqueProductId = $id . implode('', array_column($request->addonDetailsRadioButton_id, 0)) . implode('', $request->addonDetailsCheckbox_id);
            $oldCart = \Cart::session($userID)->get($uniqueProductId);

            if (!empty($oldCart)) {
                foreach ($oldCart->attributes['addonDetailsIds_Quantities'] as $key => $value) {
                    $addonDetailsIds_Quantities[$key] = $value;
                }
                foreach ($addonDetailsRadioButton_id as $addonDetailRadioButton_id) {
                    if (array_key_exists($addonDetailRadioButton_id[0], $oldCart->attributes['addonDetailsIds_Quantities'])) {
                        $addonDetailsIds_Quantities[$addonDetailRadioButton_id[0]] = $request->amount + $oldCart->attributes['addonDetailsIds_Quantities'][$addonDetailRadioButton_id[0]];

                    } else {
                        $addonDetailsIds_Quantities[$addonDetailRadioButton_id[0]] = $request->amount;
                    }
                }
                foreach ($addonDetailsCheckbox_id as $addonDetailCheckbox_id) {
                    if (array_key_exists($addonDetailCheckbox_id, $oldCart->attributes['addonDetailsIds_Quantities'])) {
                        $addonDetailsIds_Quantities[$addonDetailCheckbox_id] = $request->amount + $oldCart->attributes['addonDetailsIds_Quantities'][$addonDetailCheckbox_id];

                    } else {
                        $addonDetailsIds_Quantities[$addonDetailCheckbox_id] = $request->amount;
                    }
                }
            }

        } elseif ($request->has('addonDetails_id')) {
            $i = 0;
            $addonDetailsId = $request->addonDetails_id;
            $uniqueProductId = $id . implode('', $request->addonDetails_id);
            $addonDetailsQuantity = $request->addonDetails_quantity;

            $oldCart = \Cart::session($userID)->get($uniqueProductId);
            if (!empty($oldCart)) {
                while ($i < count($addonDetailsId)) {
                    $addonDetail = AddonSectionDetail::findorfail($addonDetailsId[$i]);
                    if (array_key_exists($addonDetailsId[$i], $oldCart->attributes['addonDetailsIds_Quantities'])) {
                        $addonDetailsIds_Quantities[$addonDetail->id] = ($addonDetailsQuantity[$i] + $oldCart->attributes['addonDetailsIds_Quantities'][$addonDetailsId[$i]]) * $request->amount;
                    }

                    $i++;
                }

            } else {
                while ($i < count($addonDetailsId)) {
                    $addonDetail = AddonSectionDetail::findorfail($addonDetailsId[$i]);
                    if (array_key_exists($i, $addonDetailsQuantity)) {

                        $addonDetailsIds_Quantities[$addonDetail->id] = $addonDetailsQuantity[$i] * $request->amount;
                    }

                    $i++;
                }
            }


        } elseif ($request->has('addonDetailsRadioButton_id')) {
            $uniqueProductId = $id . implode('', array_column($request->addonDetailsRadioButton_id, 0));
            $oldCart = \Cart::session($userID)->get($uniqueProductId);

            if (!empty($oldCart)) {

                foreach ($oldCart->attributes['addonDetailsIds_Quantities'] as $key => $value) {
                    $addonDetailsIds_Quantities[$key] = $value;
                }
                foreach ($addonDetailsRadioButton_id as $addonDetailRadioButton_id) {
                    // dd($oldCart->attributes['addonDetailsIds_Quantities'][$addonDetailRadioButton_id[0]]);

                    if (array_key_exists($addonDetailRadioButton_id[0], $oldCart->attributes['addonDetailsIds_Quantities'])) {
                        $addonDetailsIds_Quantities[$addonDetailRadioButton_id[0]] = $request->amount + $oldCart->attributes['addonDetailsIds_Quantities'][$addonDetailRadioButton_id[0]];

                    } else {
                        $addonDetailsIds_Quantities[$addonDetailRadioButton_id[0]] = $request->amount;

                    }
                }
            } else {
                foreach ($addonDetailsRadioButton_id as $addonDetailRadioButton_id) {
                    $addonDetailsIds_Quantities[$addonDetailRadioButton_id[0]] = $request->amount;
                }
            }

        } elseif ($request->has('addonDetailsCheckbox_id')) {
            $uniqueProductId = $id . implode('', $request->addonDetailsCheckbox_id);
            $oldCart = \Cart::session($userID)->get($uniqueProductId);
            //dd($oldCart);
            if (!empty($oldCart)) {
                foreach ($oldCart->attributes['addonDetailsIds_Quantities'] as $key => $value) {
                    $addonDetailsIds_Quantities[$key] = $value;
                }
                foreach ($addonDetailsCheckbox_id as $addonDetailCheckbox_id) {
                    if (array_key_exists($addonDetailCheckbox_id, $oldCart->attributes['addonDetailsIds_Quantities'])) {
                        $addonDetailsIds_Quantities[$addonDetailCheckbox_id] = $request->amount + $oldCart->attributes['addonDetailsIds_Quantities'][$addonDetailCheckbox_id];

                    } else {
                        $addonDetailsIds_Quantities[$addonDetailCheckbox_id] = $request->amount;
                    }
                }
            } else {
                foreach ($addonDetailsCheckbox_id as $addonDetailCheckbox_id) {
                    $addonDetailsIds_Quantities[$addonDetailCheckbox_id] = $request->amount;
                }
            }
        }
        $product = Product::findorfail($id);
        $ProductPricePerItem = ($product->price * $request->amount);
        $totalAddonPricePerItem = 0;
        foreach ($addonDetailsIds_Quantities as $key => $value) {
            $addonDetailPricePerItem = AddonSectionDetail::where('id', '=', $key)->value('price');
            $totalAddonPricePerItem = $totalAddonPricePerItem + ($addonDetailPricePerItem * $value);
        }
        $totalProductPricePerItem = $ProductPricePerItem + $totalAddonPricePerItem;

        \Cart::session($userID)->add(array(
            'id' => $uniqueProductId,
            'name' => $product->name_en,
            'price' => $product->price,
            'quantity' => $request->amount,
            'attributes' => array(
                'addonDetailsIds_Quantities' => $addonDetailsIds_Quantities,
                'totalAddonPrice' => $totalAddonPricePerItem,
                'totalProductPrice' => $totalProductPricePerItem,
                'product_id' => $id,
                'product_name' => $product->name_en

            )
        ));


        return Redirect()->route('order.create')->with('message', 'The item was added successfully to the Cart');
    }


    public function update(Request $request, $id)
    {
        $order = Order::findorfail($id);
        $order->update([
            'status' => $request->status
        ]);
        return Redirect::back()->with('message', 'Status updated successfully');
    }

    public function orderDetail($id)
    {
        $order = Order::with('user', 'orderItems', 'orderItems.orderItemAddons')->findOrFail($id);
        $product = Product::with('addons', 'addons.addonDetails')->findorfail($id);
        //dd($order);
        $totalItemPrice = 0;
        $totalAddonPrice = 0;
        foreach ($order->orderItems as $item) {
            $totalItemPrice = $totalItemPrice + $item->unit_price * $item->quantity;
            foreach ($item->orderItemAddons as $itemAddon) {
                $totalAddonPrice = $totalAddonPrice + $itemAddon->addon_unit_price;
            }
        }
        $totalCartPrice = $totalItemPrice + $totalAddonPrice;
        //set notification with readed
        $orderNotification = $order->notification;
        if ($orderNotification) {
            $orderNotification->update([
                'readed' => 1
            ]);
        }
        return view('vendor.orders.details', compact('order', 'totalCartPrice', 'product'));
    }

    public function refreshNewOrders()
    {
/*        $currentTime = new \DateTime();
        //check changes after last change time
        if (session()->has('lastTimeChecked')) {
            $lastCheckedTime = Session::get('lastTimeChecked');
        } else {
            $lastCheckedTime = $currentTime;
        }*/



        $unreadedNotificationsOrderIds = Notification::query()->where('readed', 0)->where('notified_id', Auth::user()->vendor_id)->where('notified_type', 'App\Models\Vendor')->where('created_at', '>', $lastCheckedTime)->pluck('notifiable_id');
        $notificationsNewOrders = Order::query()->whereIn('id', $unreadedNotificationsOrderIds)->get();
        $notifyAreaSec = view('vendor.includes.notifyAreaSec', ['notificationsNewOrders' => $notificationsNewOrders])->render();
        if (count($notificationsNewOrders) > 0) {
         /*   Session::put('lastTimeChecked', $currentTime);*/
            return response()->json(['success' => true,
                'notifyAreaSec' => $notifyAreaSec,
                'status' => Response::HTTP_CREATED]);
        }
        return response()->json(['success' => false,
        ]);

    }
}

