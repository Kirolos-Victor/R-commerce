<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_admin_id')->nullable();
            $table->string('name_en');
            $table->string('name_ar');
            $table->foreignId('country_id')->constrained();
            $table->string('url');
            $table->string('supplier_code')->nullable();
            $table->string('sms_sender')->nullable();
            $table->string('location');
            $table->string('start_working_hours')->nullable();
            $table->string('end_working_hours')->nullable();
            $table->string('start_delivery_time')->nullable();
            $table->string('end_delivery_time')->nullable();
            $table->tinyInteger('preorder_availability');
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
        Schema::dropIfExists('vendors');
    }
}
