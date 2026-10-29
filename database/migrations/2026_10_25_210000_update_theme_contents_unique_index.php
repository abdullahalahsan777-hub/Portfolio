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
        Schema::table('theme_contents', function (Blueprint $table) {
            $table->dropUnique('theme_contents_theme_key_unique');
            $table->unique(['theme', 'page', 'key'], 'theme_contents_theme_page_key_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('theme_contents', function (Blueprint $table) {
            $table->dropUnique('theme_contents_theme_page_key_unique');
            $table->unique(['theme', 'key'], 'theme_contents_theme_key_unique');
        });
    }
};
