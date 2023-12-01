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
        Schema::create('users_roles', function (Blueprint $table) {
            $table->id();
            $table->string('user_email');
            $table->string('role_name')->index();;
            $table->timestamps();

            $table->foreign('user_email')->references('email')->on('users');
            $table->foreign('role_name')->references('name')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('users_roles');
    }
};
