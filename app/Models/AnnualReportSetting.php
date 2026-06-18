<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnualReportSetting extends Model
{
    protected $table = 'annual_report_settings';

    protected $fillable = [
        'url',
        'allowed_roles',
    ];

    protected $casts = [
        'allowed_roles' => 'array',
    ];

    /**
     * Get the configured spreadsheet URL or a fallback default URL.
     */
    public static function getUrl(): string
    {
        $setting = static::first();
        return ($setting && !empty($setting->url)) ? $setting->url : 'https://docs.google.com/spreadsheets';
    }

    /**
     * Get the list of role names allowed to access the annual report.
     */
    public static function getAllowedRoles(): array
    {
        $setting = static::first();
        return ($setting && is_array($setting->allowed_roles)) 
            ? $setting->allowed_roles 
            : ['super_admin', 'Admin_Sistem', 'Pengurus_Inti', 'Staf_Ahli', 'Pengurus_Pokja_1', 'Pengurus_Pokja_2', 'Pengurus_Pokja_3', 'Pengurus_Pokja_4']; // Default allowed roles (all)
    }
}
