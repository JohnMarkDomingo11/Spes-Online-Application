<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->string('certificate_enrollment')->nullable()->after('resume');
            $table->string('certificate_grade')->nullable()->after('certificate_enrollment');
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn(['certificate_enrollment', 'certificate_grade']);
        });
    }
};