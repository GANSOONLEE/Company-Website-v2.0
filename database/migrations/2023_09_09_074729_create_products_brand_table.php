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
        Schema::create('products_brand', function (Blueprint $table) {
            $table->id();
            $table->string('sku_id');
            $table->string('brand');
            $table->string('code');
            $table->string('product_code');
            $table->string('frozen_code');
            $table->timestamps();

            $table->foreign('product_code')
                ->references('product_code')
                ->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_brand');
    }
};
