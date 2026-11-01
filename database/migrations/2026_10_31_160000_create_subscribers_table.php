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
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->string('email', 191)->unique();
            $table->string('name', 191)->nullable();
            $table->text('avatar')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('email_host', 191)->nullable();
            $table->string('user_agent', 255)->nullable();
            $table->string('status', 20)->default('active'); // active, unsubscribed
            $table->timestamp('subscribed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribers');
    }
};

