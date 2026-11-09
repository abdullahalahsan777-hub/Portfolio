<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Re-sequence sort_order theme-wise (1..N for each theme) across all website modules.
     */
    public function up(): void
    {
        $tables = [
            'services',
            'projects',
            'galleries',
            'skills',
            'pricing_plans',
            'testimonials',
            'blog_posts',
            'faqs',
        ];

        DB::transaction(function () use ($tables) {
            foreach ($tables as $table) {
                $themes = DB::table($table)->select('theme')->distinct()->pluck('theme');
                foreach ($themes as $theme) {
                    $ids = DB::table($table)
                        ->where('theme', $theme)
                        ->orderBy('sort_order')
                        ->orderBy('id')
                        ->pluck('id');

                    foreach ($ids as $index => $id) {
                        DB::table($table)->where('id', $id)->update(['sort_order' => $index + 1]);
                    }
                }
            }

            // resume_items has both 'type' (education/experience) and 'theme'
            foreach (['education', 'experience'] as $type) {
                $themes = DB::table('resume_items')
                    ->where('type', $type)
                    ->select('theme')
                    ->distinct()
                    ->pluck('theme');

                foreach ($themes as $theme) {
                    $ids = DB::table('resume_items')
                        ->where('type', $type)
                        ->where('theme', $theme)
                        ->orderBy('sort_order')
                        ->orderBy('id')
                        ->pluck('id');

                    foreach ($ids as $index => $id) {
                        DB::table('resume_items')->where('id', $id)->update(['sort_order' => $index + 1]);
                    }
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reversible via resetting to IDs if needed
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
};
