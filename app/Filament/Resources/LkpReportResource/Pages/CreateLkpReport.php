<?php

namespace App\Filament\Resources\LkpReportResource\Pages;

use App\Filament\Resources\LkpReportResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLkpReport extends CreateRecord
{
    protected static string $resource = LkpReportResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
