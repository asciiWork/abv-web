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
        Schema::table('product_review', function (Blueprint $table) {
            $table->string('review_name')->nullable()->after('review');
            $table->string('review_email')->nullable()->after('review_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_review', function (Blueprint $table) {
            $table->dropColumn('review_name');
            $table->dropColumn('review_email');
        });
    }
};
