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
        Schema::create('password_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignID('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('email');
            $table->string('token');
            $table->timestamps();
            $table->dateTime('expire_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('password_tokens');
    }
};
