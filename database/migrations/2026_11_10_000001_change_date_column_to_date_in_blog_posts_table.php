<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Normalize all existing date strings into YYYY-MM-DD
        $posts = DB::table('blog_posts')->select('id', 'date', 'created_at')->get();
        foreach ($posts as $post) {
            $normalizedDate = null;
            if (!empty($post->date) && strtotime($post->date)) {
                $normalizedDate = date('Y-m-d', strtotime($post->date));
            } elseif (!empty($post->created_at) && strtotime($post->created_at)) {
                $normalizedDate = date('Y-m-d', strtotime($post->created_at));
            } else {
                $normalizedDate = date('Y-m-d');
            }

            DB::table('blog_posts')->where('id', $post->id)->update(['date' => $normalizedDate]);
        }

        // 2. Change column type from string/varchar to date
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->date('date')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->string('date', 255)->nullable()->change();
        });
    }
};

