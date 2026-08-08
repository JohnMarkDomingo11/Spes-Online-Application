<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            // Track which post-approval forms have been filled
            $table->unsignedTinyInteger('forms_step')->default(0)->after('admin_comment');
            // form_step: 0 = not started, 1 = form2 done, 2 = form3 done, 3 = all done

            // === SPES FORM 2 — Application Form (extended) ===
            $table->string('f2_control_no')->nullable();
            $table->string('f2_place_of_birth')->nullable();
            $table->string('f2_citizenship')->nullable();
            $table->string('f2_email')->nullable();
            $table->string('f2_social_media')->nullable();
            $table->string('f2_gsis_beneficiary')->nullable();
            $table->string('f2_present_address')->nullable();
            $table->string('f2_permanent_address')->nullable();
            $table->string('f2_applicant_category')->nullable(); // STUDENT/ALS/OSY
            $table->string('f2_special_skills')->nullable();
            // Education (JSON: elementary, secondary, tertiary, techvoc)
            $table->json('f2_education_history')->nullable();
            // Parents occupation
            $table->string('f2_father_occupation')->nullable();
            $table->string('f2_mother_occupation')->nullable();
            // SPES history (JSON)
            $table->json('f2_spes_history')->nullable();
            // Consent & checklist
            $table->boolean('f2_consent_accepted')->default(false);
            $table->json('f2_checklist')->nullable();
            // Parent status (checkboxes)
            $table->string('f2_parent_status_details')->nullable();
            $table->text('f2_other_info')->nullable();

            // === SPES FORM 3 — Employment Details ===
            $table->string('f3_employer_name')->nullable();
            $table->string('f3_employer_address')->nullable();
            $table->string('f3_position')->nullable();
            $table->date('f3_start_date')->nullable();
            $table->date('f3_end_date')->nullable();
            $table->unsignedSmallInteger('f3_work_days')->nullable();
            $table->string('f3_wage_rate')->nullable();
            $table->string('f3_work_schedule')->nullable();
            $table->string('f3_supervisor_name')->nullable();
            $table->string('f3_supervisor_contact')->nullable();
            $table->text('f3_duties')->nullable();

            // === SPES FORM 4 — Employment Contract ===
            $table->string('f4_employer_name')->nullable();
            $table->string('f4_employer_address')->nullable();
            $table->string('f4_position')->nullable();
            $table->date('f4_contract_start')->nullable();
            $table->date('f4_contract_end')->nullable();
            $table->unsignedSmallInteger('f4_contract_days')->nullable();
            $table->string('f4_wage_percent')->nullable();
            $table->date('f4_signed_date')->nullable();
            $table->string('f4_signed_place')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn([
                'forms_step',
                'f2_control_no','f2_place_of_birth','f2_citizenship','f2_email',
                'f2_social_media','f2_gsis_beneficiary','f2_present_address',
                'f2_permanent_address','f2_applicant_category','f2_special_skills',
                'f2_education_history','f2_father_occupation','f2_mother_occupation',
                'f2_spes_history','f2_consent_accepted','f2_checklist',
                'f2_parent_status_details','f2_other_info',
                'f3_employer_name','f3_employer_address','f3_position',
                'f3_start_date','f3_end_date','f3_work_days','f3_wage_rate',
                'f3_work_schedule','f3_supervisor_name','f3_supervisor_contact','f3_duties',
                'f4_employer_name','f4_employer_address','f4_position',
                'f4_contract_start','f4_contract_end','f4_contract_days',
                'f4_wage_percent','f4_signed_date','f4_signed_place',
            ]);
        });
    }
};
