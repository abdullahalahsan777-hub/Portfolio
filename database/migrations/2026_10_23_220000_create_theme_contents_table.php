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
        Schema::create('theme_contents', function (Blueprint $table) {
            $table->id();
            $table->string('theme', 50)->index();
            $table->string('section', 50)->default('general')->index();
            $table->string('key', 100)->index();
            $table->longText('value')->nullable();
            $table->string('type', 30)->default('text'); // text, textarea, image, json, number
            $table->timestamps();

            $table->unique(['theme', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theme_contents');
    }
};
