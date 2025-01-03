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
            $table->integer('userid');
            $table->string('shipping_recipient_name');
            $table->string('shipping_phone_number');
            $table->string('shipping_city_name');
            $table->string('shipping_postal_code');
            $table->string('shipping_address');
            $table->string('product_image');
            $table->string('product_name');
            $table->integer('product_quentity');
            $table->integer('total_price');
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
