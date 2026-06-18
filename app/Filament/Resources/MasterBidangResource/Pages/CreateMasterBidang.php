<?php

namespace App\Filament\Resources\MasterBidangResource\Pages;

use App\Filament\Resources\MasterBidangResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMasterBidang extends CreateRecord
{
    protected static string $resource = MasterBidangResource::class;

    protected \Filament\Support\Enums\Width|string|null $maxContentWidth = '5xl';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
