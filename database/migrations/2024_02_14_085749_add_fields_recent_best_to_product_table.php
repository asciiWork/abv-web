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
        Schema::table('product', function (Blueprint $table) {
            $table->enum('best_seller', ['0', '1'])->comment('1-yes,0-no')->after('size_in_mm');
            $table->enum('recent_product', ['0', '1'])->comment('1-yes,0-no')->after('best_seller');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn('best_seller');
            $table->dropColumn('recent_product');
        });
    }
};
