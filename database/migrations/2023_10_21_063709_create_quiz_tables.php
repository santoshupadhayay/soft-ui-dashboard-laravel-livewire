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
        Schema::create('quizs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name')->nullable();
            $table->text('description')->nullable();
            $table->text('status')->nullable();
            $table->unsignedBigInteger('chapter_id')->foreign('chapter_id')->references('id')->on('chapters')->cascadeOnDelete();
            $table->timestamps();
        });
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('quesion')->nullable();
            $table->text('description')->nullable();
            $table->text('status')->nullable();
            $table->unsignedBigInteger('quiz_id')->foreign('quiz_id')->references('id')->on('quizs')->cascadeOnDelete();
            $table->timestamps();
        });
        Schema::create('question_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('option')->nullable();
            $table->boolean('is_correct')->nullable();
            $table->text('status')->nullable();
            $table->unsignedBigInteger('question_id')->foreign('question_id')->references('id')->on('questions')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizs');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('question_options');
    }
};
