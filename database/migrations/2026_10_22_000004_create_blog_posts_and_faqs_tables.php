<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Blog Posts Table
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('General');
            $table->string('date')->nullable();
            $table->string('read_time')->default('5 min read');
            $table->string('author')->default('Alex Rivera');
            $table->text('image')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->string('theme')->default('all');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        // FAQs Table
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->string('category')->default('General');
            $table->string('theme')->default('all');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('faqs');
        Schema::dropIfExists('blog_posts');
    }
};
