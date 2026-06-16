<?php

namespace App\Filament\Resources\LkpReportResource\Pages;

use App\Filament\Resources\LkpReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLkpReport extends EditRecord
{
    protected static string $resource = LkpReportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
