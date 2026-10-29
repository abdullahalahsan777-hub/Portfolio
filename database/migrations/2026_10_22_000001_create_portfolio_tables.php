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
        // Add role & profile fields to users table
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user')->after('email'); // 'admin' or 'user'
            $table->string('avatar')->nullable()->after('role');
            $table->string('phone')->nullable()->after('avatar');
        });

        // Site Settings (Key-Value dynamic configuration)
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('group')->default('general');
            $table->timestamps();
        });

        // Services
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('icon')->nullable(); // SVG or icon class name
            $table->string('category')->default('design');
            $table->string('theme')->default('all'); // 'developer', 'graphic_designer', 'uiux_designer', 'all'
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Projects
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('category');
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->string('demo_url')->nullable();
            $table->string('github_url')->nullable();
            $table->string('tags')->nullable(); // comma-separated
            $table->string('theme')->default('all');
            $table->boolean('is_featured')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Skills
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->default('core'); // e.g., 'frontend', 'backend', 'design', 'tools'
            $table->integer('percentage')->default(90);
            $table->text('icon')->nullable();
            $table->string('theme')->default('all');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Pricing Plans
        Schema::create('pricing_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Basic, Standard, Premium
            $table->string('subtitle')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->string('billing_period')->default('project'); // project, month, hour
            $table->text('features')->nullable(); // JSON or newline separated
            $table->boolean('is_featured')->default(false);
            $table->string('button_text')->default('Start Project');
            $table->string('button_url')->default('#contact');
            $table->string('theme')->default('all');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Testimonials
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_role');
            $table->string('company')->nullable();
            $table->string('avatar')->nullable();
            $table->integer('rating')->default(5);
            $table->text('content');
            $table->string('theme')->default('all');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Contact Inquiries / Messages
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('subject')->nullable();
            $table->string('service_type')->nullable();
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('pricing_plans');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('services');
        Schema::dropIfExists('site_settings');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'avatar', 'phone']);
        });
    }
};
