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
        Schema::create('registrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->integer('age');
            $table->bigInteger('phone')->nullable();
            $table->unsignedBigInteger('stream_id')->foreign('stream_id')->references('id')->on('streams')->cascadeOnDelete();;
            $table->unsignedBigInteger('chapter_id')->foreign('chapter_id')->references('id')->on('chapters')->cascadeOnDelete();; 
            $table->text('certificate')->nullable();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
