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
        Schema::create('operations', function (Blueprint $table) {
            $table->string('email');
            $table->string('operation_type');
            $table->string('operation_category');

            $table->foreign('email')
                ->references('email')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('operations');
    }
};
