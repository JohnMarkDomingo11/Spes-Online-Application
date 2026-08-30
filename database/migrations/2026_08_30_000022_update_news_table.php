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
        Schema::table('news', function (Blueprint $table) {
            // Add missing columns if they don't exist
            if (!Schema::hasColumn('news', 'is_published')) {
                $table->boolean('is_published')->default(false)->after('content');
            }
            if (!Schema::hasColumn('news', 'created_by')) {
                $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('cascade')->after('published_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            if (Schema::hasColumn('news', 'is_published')) {
                $table->dropColumn('is_published');
            }
            if (Schema::hasColumn('news', 'created_by')) {
                $table->dropForeign(['created_by']);
                $table->dropColumn('created_by');
            }
        });
    }
};
