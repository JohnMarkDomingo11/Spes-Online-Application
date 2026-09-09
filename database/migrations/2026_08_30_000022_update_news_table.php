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
        if (!Schema::hasTable('news')) {
            Schema::create('news', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->longText('content');
                $table->boolean('is_published')->default(false);
                $table->timestamp('published_at')->nullable();
                $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('cascade');
                $table->timestamps();
            });

            return;
        }

        Schema::table('news', function (Blueprint $table) {
            if (!Schema::hasColumn('news', 'title')) {
                $table->string('title')->after('id');
            }
            if (!Schema::hasColumn('news', 'content')) {
                $table->longText('content')->after('title');
            }
            if (!Schema::hasColumn('news', 'is_published')) {
                $table->boolean('is_published')->default(false)->after('content');
            }
            if (!Schema::hasColumn('news', 'published_at')) {
                $table->timestamp('published_at')->nullable()->after('is_published');
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
        if (Schema::hasTable('news')) {
            Schema::drop('news');
        }
    }
};
