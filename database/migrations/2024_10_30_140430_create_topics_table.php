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
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            // templates? for well layed out topics?
    
            // Author of topic, not sure i want it to cascade deleting? So null on delete?
            $table->unsignedBigInteger('author_id')->nullable();
            $table->foreign('author_id')->references('id')->on('users')->nullOnDelete()->onUpdate('cascade');

            // Title of topic
            $table->string('title');

            // Content
            $table->text('content'); // Probably need to do multi-media here
            
            // Seperate date which keeps track of actual topic date?
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topics');
    }
};
