<?php

namespace App\Filament\Resources\LkpReportResource\Pages;

use App\Filament\Resources\LkpReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLkpReports extends ListRecords
{
    protected static string $resource = LkpReportResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
