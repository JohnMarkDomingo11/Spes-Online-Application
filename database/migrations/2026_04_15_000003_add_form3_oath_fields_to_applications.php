<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->string('f3_beneficiary_name')->nullable();
            $table->string('f3_beneficiary_age')->nullable();
            $table->string('f3_beneficiary_years')->nullable();
            $table->string('f3_beneficiary_address')->nullable();
            $table->string('f3_signed_day')->nullable();
            $table->string('f3_signed_month')->nullable();
            $table->string('f3_signed_year')->nullable();
            $table->string('f3_signed_city')->nullable();
            $table->string('f3_parent_guardian_name')->nullable();
            $table->string('f3_beneficiary_signature')->nullable();
            $table->string('f3_witnessed_by')->nullable();
            $table->string('f3_witnessed_date')->nullable();
            $table->string('f3_noted_by')->nullable();
            $table->string('f3_noted_date')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn([
                'f3_beneficiary_name',
                'f3_beneficiary_age',
                'f3_beneficiary_years',
                'f3_beneficiary_address',
                'f3_signed_day',
                'f3_signed_month',
                'f3_signed_year',
                'f3_signed_city',
                'f3_parent_guardian_name',
                'f3_beneficiary_signature',
                'f3_witnessed_by',
                'f3_witnessed_date',
                'f3_noted_by',
                'f3_noted_date',
            ]);
        });
    }
};
