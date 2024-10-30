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
            $table->foreign('author_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            
            // Parent
            $table->integer('parent_id')->nullable()->references('id')->on('comments')->cascadeOnDelete()->cascadeOnUpdate(); // maybe on update?

            // Content
            $table->string('content');
            
            // Ratings
            $table->integer('likes')->default(0);
            $table->integer('dislikes')->default(0);
            
            // Edited flag
            $table->boolean('edited')->default(false);

            // Commentable
            $table->morphs('commentable'); // Can comment under comments or articles

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
