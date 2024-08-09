<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->string('account_id');
            $table->string('order_refrence');

// order_state table chi forgeing key ithe difine keli ye 
            $table->unsignedBigInteger('order_stage')->default(1);
            $table->foreign('order_stage')->references('id')->on('order_states');

            $table->string('customer_name');
            $table->string('product_image_link');
            $table->string('customer_mobile_no',10);
            $table->string('state_name');
            $table->string('customer_address');
            $table->string('customer_pincode',6);
            $table->string('product_name');
            $table->string('product_price_gross');
            $table->string('product_dilevery_charge');
            $table->string('product_total_payble_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
