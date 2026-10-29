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
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->string('type', 20)->default('inbox')->after('service_type')->index();
            $table->string('temp_id', 64)->nullable()->after('type')->index();
            $table->boolean('is_important')->default(false)->after('temp_id')->index();
            $table->softDeletes()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropIndex(['type']);
            $table->dropIndex(['temp_id']);
            $table->dropIndex(['is_important']);
            $table->dropColumn(['type', 'temp_id', 'is_important']);
            $table->dropSoftDeletes();
        });
    }
};
