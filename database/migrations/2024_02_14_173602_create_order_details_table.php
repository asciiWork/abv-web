<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->nullable()->unsigned();
            $table->bigInteger('product_id')->nullable()->unsigned();
            $table->string('discount')->nullable();
            $table->string('amount')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('quantity')->nullable();
            $table->string('unit_price')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('CASCADE')->onDelete('CASCADE');
            //$table->foreign('product_id')->references('id')->on('product')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
};
