<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $fillable = [
        'application_start_date',
        'application_end_date',
    ];

    protected $casts = [
        'application_start_date' => 'datetime',
        'application_end_date' => 'datetime',
    ];

    /**
     * Get or create the current system settings (single row)
     */
    public static function current()
    {
        return self::firstOrCreate([]);
    }

    /**
     * Check if applications are currently open
     */
    public function isApplicationOpen()
    {
        $now = now();
        
        if ($this->application_start_date === null || $this->application_end_date === null) {
            return false; // Both dates must be set
        }

        return $now->isBetween($this->application_start_date, $this->application_end_date);
    }
}
