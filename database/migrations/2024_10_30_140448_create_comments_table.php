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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            // Author (maybe change author_id to user_id)
            $table->unsignedBigInteger('author_id')->nullable();
            $table->foreign('author_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            
            // Article
            $table->unsignedBigInteger('article_id')->nullable();
            $table->foreign('article_id')->references('id')->on('articles')->cascadeOnDelete()->cascadeOnUpdate();

            // Parent comment
            $table->unsignedBigInteger('parent_id')->nullable()->references('id')->on('comments')->cascadeOnDelete()->cascadeOnUpdate();

            // Content
            $table->text('content');
            
            // Edited flag
            $table->boolean('edited')->default(false);

            // Original content
            $table->text('original_content')->nullable()->default(null);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
