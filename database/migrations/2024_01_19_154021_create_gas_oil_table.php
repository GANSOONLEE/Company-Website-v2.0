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
        Schema::create('gas_oil', function (Blueprint $table) {
            $table->id();
            $table->string('model_name'); // Proton
            $table->string('model_serial_name'); // Saga
            $table->string('oil');
            $table->string('gas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gas_oil');
    }
};
