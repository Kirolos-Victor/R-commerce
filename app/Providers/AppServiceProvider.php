<?php

namespace App\Providers;

use App\Models\Notification;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        //
        Schema::defaultStringLength(191);
        //view share orders notifications in all views

//compose all the views....
        view()->composer('*', function ($view) {
            if(Auth::check()){
                $unreadedNotificationsOrderIds = Notification::query()->where('readed', 0)->where('notified_id', Auth::user()->vendor_id)->where('notified_type', 'App\Models\Vendor')->where('notifiable_type', 'App\Models\Order')->pluck('notifiable_id');
                $notificationsNewOrders = Order::query()->whereIn('id',$unreadedNotificationsOrderIds)->get();

                //...with this variable
                $view->with('notificationsNewOrders', $notificationsNewOrders);
            }
        });
    }
}
