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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignID('id_user')->constrained('users', 'id')->onDelete('cascade');
            $table->string('name');
            $table->string('price');
            $table->foreignID('id_category')->nullable()->constrained('categories', 'id')->onDelete('set null');
            $table->foreignID('id_brand')->nullable()->constrained('brands', 'id')->onDelete('set null');
            $table->unsignedInteger('status')->default(1)->comment('0:sale 1:new');
            $table->string('sale')->nullable();
            $table->string('company');
            $table->longText('detail');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
