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
            $table->string('sub_title');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->decimal('discount', 10, 2)->nullable();
            $table->decimal('net_price', 10, 2)->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('featured_video')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->json('data')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('courses');
            $table->foreignId('category_id')->nullable()->constrained('categories');
            $table->foreignId('stage_id')->nullable()->constrained('stages');
            $table->timestamps();
            $table->softDeletes();
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
