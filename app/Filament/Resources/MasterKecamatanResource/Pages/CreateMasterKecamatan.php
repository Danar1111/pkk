<?php

namespace App\Filament\Resources\MasterKecamatanResource\Pages;

use App\Filament\Resources\MasterKecamatanResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMasterKecamatan extends CreateRecord
{
    protected static string $resource = MasterKecamatanResource::class;

    protected \Filament\Support\Enums\Width|string|null $maxContentWidth = '5xl';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
