<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tables = [
            'services',
            'projects',
            'galleries',
            'skills',
            'resume_items',
            'pricing_plans',
            'testimonials',
            'blog_posts',
            'faqs',
        ];

        foreach ($tables as $table) {
            DB::table($table)->update(['sort_order' => DB::raw('id')]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No reversal needed for data synchronization
    }
};

