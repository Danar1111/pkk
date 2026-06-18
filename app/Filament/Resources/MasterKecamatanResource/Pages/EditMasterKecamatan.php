<?php

namespace App\Filament\Resources\MasterKecamatanResource\Pages;

use App\Filament\Resources\MasterKecamatanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMasterKecamatan extends EditRecord
{
    protected static string $resource = MasterKecamatanResource::class;

    protected \Filament\Support\Enums\Width|string|null $maxContentWidth = '5xl';

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
