<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Drop old applications table and create a fully-featured one
     * with all required fields per system spec.
     */
    public function up(): void
    {
        Schema::dropIfExists('applications');

        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('ref_id')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Personal Information
            $table->string('full_name');
            $table->enum('sex', ['Male', 'Female']);
            $table->date('birthday');
            $table->unsignedTinyInteger('age');
            $table->string('barangay');
            $table->enum('civil_status', ['Single', 'Married', 'Widowed', 'Separated']);
            $table->enum('parent_status', ['Both Parents', 'Single Parent', 'Orphan', 'Guardian']);
            $table->string('education'); // educational attainment
            $table->enum('spes_status', ['new', 'baby']); // new = first time, baby = 2nd/3rd

            // Family Info
            $table->string('mother_name');
            $table->string('father_guardian_name');

            // Contact
            $table->string('contact_no', 20);
            $table->string('messenger')->nullable();

            // Uploaded documents
            $table->string('resume')->nullable();
            $table->string('application_letter')->nullable();
            $table->string('indigency')->nullable();

            // Status & admin feedback
            $table->enum('status', ['pending', 'approved', 'denied'])->default('pending');
            $table->text('admin_comment')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
