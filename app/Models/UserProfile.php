<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $table = 'users_profile';

    protected $fillable = [
        'user_id',
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
    ];

    protected $casts = [
        'education_history' => 'array',
        'parent_status_details' => 'array',
        'date_of_birth' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
