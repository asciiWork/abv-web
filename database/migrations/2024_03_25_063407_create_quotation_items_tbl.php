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
        Schema::create('quotation_items', function (Blueprint $table) {
            $table->id();
            $table->integer('quotation_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('product_size_id')->nullable();
            $table->string('item_name')->nullable();
            $table->string('product_actual_price')->nullable();
            $table->string('quantity')->nullable();
            $table->string('taxable_value')->nullable();
            $table->string('tax_amount')->nullable();
            $table->string('total_amount')->nullable();
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
        Schema::dropIfExists('quotation_items');
    }
};
