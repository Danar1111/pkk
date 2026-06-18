<?php

namespace App\Filament\Resources\AnnualReportSettingResource\Pages;

use App\Filament\Resources\AnnualReportSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAnnualReportSetting extends EditRecord
{
    protected static string $resource = AnnualReportSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', ['record' => $this->getRecord()]);
    }
}
