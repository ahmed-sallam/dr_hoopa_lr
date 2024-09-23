<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('sub_title');
            $table->text('description');
            $table->boolean('is_premium')->default(true);
            $table->string('thumbnail')->nullable();
            $table->string(column: 'content_url')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum(column: 'content_type', allowed: ['video', 'quiz', 'item'])->default('video');
            $table->integer('order')->default(0);
            // $table->integer('duration')->default(0);
            $table->json('data')->nullable();
            $table->foreignId('course_id')->constrained('courses');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
