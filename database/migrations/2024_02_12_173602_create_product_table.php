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
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('product_name', 200);
            $table->double('product_min_price', 10, 2);
            $table->double('product_max_price', 10, 2);
            $table->double('product_offer_per', 10, 2);
            $table->text('product_slug');
            $table->text('product_detail');
            $table->dateTime('created_date')->useCurrent();
            $table->dateTime('updated_date')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
};
