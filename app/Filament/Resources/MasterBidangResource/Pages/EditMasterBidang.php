<?php

namespace App\Filament\Resources\MasterBidangResource\Pages;

use App\Filament\Resources\MasterBidangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMasterBidang extends EditRecord
{
    protected static string $resource = MasterBidangResource::class;

    protected \Filament\Support\Enums\Width|string|null $maxContentWidth = '5xl';

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction(),
            $this->getCancelFormAction(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
