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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->string('client_address')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('quotation_number')->nullable();
            $table->string('invoice_date')->nullable();
            $table->string('quotation_date')->nullable();
            $table->string('quotation_due_date')->nullable();
            $table->string('total_taxable_value')->nullable();
            $table->string('shipping_amount')->nullable();
            $table->string('gst_amount')->nullable();
            $table->string('final_total_amount')->nullable();
            $table->string('final_total_amount_words')->nullable();
            $table->integer('is_invoice')->nullable()->default(0)->comment('qn-0, invoice-1');
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
        Schema::dropIfExists('quotations');
    }
};
