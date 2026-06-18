<?php

namespace Database\Seeders;

use App\Models\AnnualReportSetting;
use Illuminate\Database\Seeder;

class AnnualReportSettingSeeder extends Seeder
{
    public function run(): void
    {
        AnnualReportSetting::firstOrCreate(
            ['id' => 1],
            [
                'url' => 'https://docs.google.com/spreadsheets/d/1tLhYqWz5S5O34XvU6_p2H0d_L2qB7s-6E8n8H-c8N8/edit', // Placeholder Google Sheet URL
                'allowed_roles' => [
                    'super_admin',
                    'Admin_Sistem',
                    'Pengurus_Inti',
                    'Staf_Ahli',
                    'Pengurus_Pokja_1',
                    'Pengurus_Pokja_2',
                    'Pengurus_Pokja_3',
                    'Pengurus_Pokja_4',
                ],
            ]
        );
    }
}
