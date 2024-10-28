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
            $table->foreignID('id_blog')->references('id')->on('blogs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignID('id_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('avatar')->nullable();
            $table->string('name');
            $table->longText('cmt');
            $table->unsignedInteger('level')->default(0)->comments('0:Cha idCha:Con');
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
