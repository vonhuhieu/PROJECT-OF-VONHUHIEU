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
        Schema::create('blog_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignID('id_blog')->constrained('blogs', 'id')->onDelete('cascade');
            $table->foreignID('id_user')->constrained('users', 'id')->onDelete('cascade');
            $table->string('avatar')->nullable();
            $table->string('name');
            $table->longText('cmt');
            $table->unsignedInteger('level');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_comments');
    }
};
