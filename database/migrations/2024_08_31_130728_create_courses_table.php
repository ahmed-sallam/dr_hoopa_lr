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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique(); // For SEO-friendly URLs
            $table->string('sub_title');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->decimal('discount', 10, 2)->default(0.00)->nullable();;
            $table->decimal('net_price', 10, 2);
            $table->string('thumbnail')->nullable();
            $table->string('featured_video')->nullable();
            $table->integer('duration_in_minutes')->default(0);
            $table->integer('total_lessons')->default(0);
            $table->integer('total_students')->default(0);
            $table->decimal('average_rating', 3, 2)->default(0.00);
            $table->integer('ratings_count')->default(0);
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->json('data')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('courses');
            $table->foreignId('category_id')->nullable()->constrained('categories');
            $table->foreignId('stage_id')->nullable()->constrained('stages');
            $table->foreignId('instructor_id')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('status');
            $table->index('instructor_id');
            $table->index('stage_id');
            $table->index('parent_id');
            $table->index('category_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
