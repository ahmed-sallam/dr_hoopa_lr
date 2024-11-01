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
            $table->string('slug')->unique(); // For SEO-friendly URLs
            $table->string('sub_title');
            $table->text('description');
            $table->boolean('is_premium')->default(true); // false For free preview lessons
            $table->string('thumbnail')->nullable();
            $table->string('content_url')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->enum('content_type', [
                'video',
                'quiz',
                'pdf',
                'item'
            ])->default('video');
            $table->integer('order')->default(0);
            $table->integer('duration')->default(0); // in seconds
            $table->json('data')->nullable(); // For quiz questions or additional metadata
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade');
            $table->integer('views_count')->default(0);
            $table->integer('completions_count')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['course_id', 'order']);
            $table->index('status');
            $table->index('content_type');
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
