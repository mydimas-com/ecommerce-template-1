<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderShippingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_shipping', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_order');
            $table->string('resi')->nullable();
            $table->string('sender_name');
            $table->string('receiver_name');
            $table->string('sender_phone');
            $table->string('receiver_phone');
            $table->string('shipment_agent');
            $table->string('shipping_address_from');
            $table->string('shipping_address_to');
            $table->string('shipping_cost');
            $table->enum('status', array('inprogress', 'shipping', 'success'));
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
        Schema::dropIfExists('order_shipping');
    }
}
