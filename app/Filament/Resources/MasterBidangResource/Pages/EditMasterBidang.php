<?php

namespace App\Filament\Resources\MasterBidangResource\Pages;

use App\Filament\Resources\MasterBidangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMasterBidang extends EditRecord
{
    protected static string $resource = MasterBidangResource::class;

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
