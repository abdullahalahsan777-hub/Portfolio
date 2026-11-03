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
        if (Schema::hasColumn('galleries', 'caption')) {
            Schema::table('galleries', function (Blueprint $table) {
                $table->dropColumn('caption');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasColumn('galleries', 'caption')) {
            Schema::table('galleries', function (Blueprint $table) {
                $table->text('caption')->nullable()->after('image_url');
            });
        }
    }
};
