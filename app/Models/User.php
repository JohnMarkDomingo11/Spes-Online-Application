<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Application;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'role',
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
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date',
            'education_history' => 'array',
            'parent_status_details' => 'array',
        ];
    }

    public function getProfilePhotoUrlAttribute(): ?string
    {
        return $this->profile_photo ? asset('storage/' . $this->profile_photo) : null;
    }

    /**
     * A user may have many applications.
     */
    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }
}
