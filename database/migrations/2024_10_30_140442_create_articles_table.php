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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            // Author of article
            $table->unsignedBigInteger('author_id')->nullable();
            $table->foreign('author_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            
            // not sure how to handle if topic is deleted?
            // Topic article is under
            $table->unsignedBigInteger('topic_id')->nullable();
            $table->foreign('topic_id')->references('id')->on('topics')->nullOnDelete()->onUpdate('cascade');
            
            // maybe have templates?

            // Title of Article
            $table->string('title');

            // Article content
            $table->text('content');
            
            // Edited flag
            $table->boolean('edited')->default(false);

            // Original content (if edited)
            $table->text('original_content')->nullable()->default(null);

            $table->timestamps(); // has created at and last updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
