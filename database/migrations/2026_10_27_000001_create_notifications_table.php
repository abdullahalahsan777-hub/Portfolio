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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('type')->default('general'); // inquiry, user, project, blog, service, system, auth, etc.
            $table->string('title');
            $table->text('message');
            $table->string('action_url')->nullable();
            $table->string('icon')->default('bell'); // bell, mail, user, folder, book, settings, alert, check, send
            $table->string('color')->default('indigo'); // indigo, emerald, amber, rose, cyan, purple, blue
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->json('data')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'is_read']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
