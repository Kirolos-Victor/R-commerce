<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained();
            $table->string('order_code');
            $table->string('status');
            $table->string('shipping_address');
            $table->string('total');
            $table->string('sub_total');
            $table->string('total_discount');
            $table->string('delivery_charges');
            $table->string('payment_method');
            $table->string('created_month');
            $table->string('user_name');
            $table->string('phone');
            $table->string('order_type');
            $table->foreignId('branch_id')->nullable()->constrained();
            $table->foreignId('area_id')->nullable()->constrained();
            $table->string('payment_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
