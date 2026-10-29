<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resume_items', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('education'); // 'education' or 'experience'
            $table->string('title');
            $table->string('institution')->nullable();
            $table->string('company')->nullable();
            $table->string('period');
            $table->string('grade')->nullable();
            $table->text('description')->nullable();
            $table->string('theme')->default('all');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resume_items');
    }
};
