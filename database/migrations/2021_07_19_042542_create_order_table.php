<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_store');
            $table->unsignedBigInteger('id_customer');
            $table->string('no_order');
            $table->integer('tax');
            $table->integer('discount');
            $table->integer('subtotal');
            $table->integer('total');
            $table->timestamp('order_date')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('order_expire')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->enum('status', array('pending','expired', 'canceled','settlement', 'inprogress', 'shipping', 'success'));
            $table->string('payment_code');
            $table->string('payment_method');
            $table->timestamp('payment_date')->nullable();
            $table->timestamp('cancelled_date')->nullable();
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
        Schema::dropIfExists('order');
    }
}
