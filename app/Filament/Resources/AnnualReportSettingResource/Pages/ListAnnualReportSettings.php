<?php

namespace App\Filament\Resources\AnnualReportSettingResource\Pages;

use App\Filament\Resources\AnnualReportSettingResource;
use App\Models\AnnualReportSetting;
use Filament\Resources\Pages\ListRecords;

class ListAnnualReportSettings extends ListRecords
{
    protected static string $resource = AnnualReportSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function mount(): void
    {
        $record = AnnualReportSetting::firstOrCreate(
            ['id' => 1],
            [
                'url' => 'https://docs.google.com/spreadsheets/d/1tLhYqWz5S5O34XvU6_p2H0d_L2qB7s-6E8n8H-c8N8/edit',
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

        $this->redirect($this->getResource()::getUrl('edit', ['record' => $record]));
    }
}
