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
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_photo')->nullable()->after('email');
            $table->string('last_name')->nullable()->after('profile_photo');
            $table->string('first_name')->nullable()->after('last_name');
            $table->string('middle_name')->nullable()->after('first_name');
            $table->enum('sex', ['Male', 'Female'])->nullable()->after('middle_name');
            $table->date('date_of_birth')->nullable()->after('sex');
            $table->string('place_of_birth')->nullable()->after('date_of_birth');
            $table->string('status')->nullable()->after('place_of_birth');
            $table->string('citizenship')->nullable()->after('status');
            $table->string('social_media')->nullable()->after('citizenship');
            $table->string('gsis_beneficiary')->nullable()->after('social_media');
            $table->string('contact_number')->nullable()->after('gsis_beneficiary');
            $table->string('present_address')->nullable()->after('contact_number');
            $table->string('permanent_address')->nullable()->after('present_address');
            $table->string('applicant_category')->nullable()->after('permanent_address');
            $table->json('education_history')->nullable()->after('applicant_category');
            $table->string('father_name')->nullable()->after('education_history');
            $table->string('father_contact_number')->nullable()->after('father_name');
            $table->string('father_occupation')->nullable()->after('father_contact_number');
            $table->string('mother_name')->nullable()->after('father_occupation');
            $table->string('mother_contact_number')->nullable()->after('mother_name');
            $table->string('mother_occupation')->nullable()->after('mother_contact_number');
            $table->json('parent_status_details')->nullable()->after('mother_occupation');
            $table->string('special_skills')->nullable()->after('parent_status_details');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'profile_photo',
                'last_name',
                'first_name',
                'middle_name',
                'sex',
                'date_of_birth',
                'place_of_birth',
                'status',
                'citizenship',
                'social_media',
                'gsis_beneficiary',
                'contact_number',
                'present_address',
                'permanent_address',
                'applicant_category',
                'education_history',
                'father_name',
                'father_contact_number',
                'father_occupation',
                'mother_name',
                'mother_contact_number',
                'mother_occupation',
                'parent_status_details',
                'special_skills',
            ]);
        });
    }
};
