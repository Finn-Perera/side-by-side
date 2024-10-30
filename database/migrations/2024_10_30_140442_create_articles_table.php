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
            
            // not sure how to handle if topic is deleted?
            $table->foreign('topic_id')->references('id')->on('topics')->nullOnDelete()->onUpdate('cascade');
            
            $table->foreign('author_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            
            // maybe have templates?

            $table->string('title');
            $table->string('content');
            $table->integer('unique_views')->default(0); // maybe this isnt great
            
            // Should ratings be visible? or should it be like tags instead interesting, informative...
            $table->integer('likes')->default(0);
            $table->integer('dislikes')->default(0);
            
            // edited flag
            $table->boolean('edited')->default(false);

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
