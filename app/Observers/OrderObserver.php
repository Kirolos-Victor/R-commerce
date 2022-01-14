<?php

namespace App\Observers;

use App\Models\AddonSectionDetail;
use App\Models\Notification;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemAddon;
use App\Models\Product;
use Carbon\Carbon;

class OrderObserver
{

    public function created(Order $order)
    {
        logger(__FUNCTION__);
        $items = \Cart::session(Auth('vendor')->user()->id)->getContent();
        foreach ($items as $item) {
            $orderItemId = OrderItem::insertGetId([
                'order_id' => $order->id,
                'product_name' => $item->attributes['product_name'],
                'unit_price' => $item->price,
                'discounted_price' => 0,
                'quantity' => $item->quantity,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            if (!empty($item->attributes['addonDetailsIds_Quantities'])) {
                foreach ($item->attributes['addonDetailsIds_Quantities'] as $key => $value) {
                    $addon = AddonSectionDetail::where('id', '=', $key)->select('id', 'price', 'name_en')->first();
                    OrderItemAddon::create([
                        'order_item_id' => $orderItemId,
                        'addon_id' => $key,
                        'addon_unit_price' => $addon->price,
                        'addon_quantity' => $value,
                        'addon_name' => $addon->name_en
                    ]);
                }

            }
            \Cart::session(Auth('vendor')->user()->id)->remove($item->id);
        }
        //create order notifications
        Notification::query()->create(
            [
                'notifiable_type' => get_class($order),
                'notifiable_id' => $order->id,
                'notified_type' => get_class($order->vendor),
                'notified_id' => $order->vendor_id,
                'title' => 'New Order',
                'message' => 'Order created no : ' . $order->id,
            ]
        );

    }


    public function updated(Order $order)
    {
        //
    }


    public function deleted(Order $order)
    {
        //
    }

    public function restored(Order $order)
    {
        //
    }


    public function forceDeleted(Order $order)
    {
        //
    }
}
