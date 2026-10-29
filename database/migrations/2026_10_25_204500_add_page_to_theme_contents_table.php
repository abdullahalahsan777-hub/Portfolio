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
            if (!Schema::hasColumn('theme_contents', 'page')) {
                $table->string('page', 50)->default('home')->after('theme')->index();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('theme_contents', function (Blueprint $table) {
            if (Schema::hasColumn('theme_contents', 'page')) {
                $table->dropColumn('page');
            }
        });
    }
};
