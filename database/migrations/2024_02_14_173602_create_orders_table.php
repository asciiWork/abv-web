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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->datetime('order_date')->nullable();
            $table->string('discount')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('tax')->nullable();
            $table->string('shipping_charge')->nullable();
            $table->string('order_tax_amount_total')->nullable();
            
            $table->string('ship_name')->nullable();
            $table->string('ship_phone')->nullable();
            $table->string('ship_street')->nullable();
            $table->string('ship_company')->nullable();
            $table->string('ship_area')->nullable();
            $table->string('ship_city')->nullable();
            $table->string('ship_state')->nullable();
            $table->string('ship_zipcode')->nullable();
            $table->datetime('ship_date')->nullable();

            $table->string('bil_name')->nullable();
            $table->string('bil_phone')->nullable();
            $table->string('bil_street')->nullable();
            $table->string('bil_company')->nullable();
            $table->string('bil_area')->nullable();
            $table->string('bil_city')->nullable();
            $table->string('bil_state')->nullable();
            $table->string('bil_zipcode')->nullable();

            $table->string('country')->nullable();
            $table->string('note')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('order_status')->nullable();

            $table->integer('is_confirm')->nullable()->default(0);
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
};
