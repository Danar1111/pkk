<?php

namespace App\Filament\Resources\MasterBidangResource\Pages;

use App\Filament\Resources\MasterBidangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMasterBidangs extends ListRecords
{
    protected static string $resource = MasterBidangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
