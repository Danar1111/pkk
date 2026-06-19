<?php

namespace App\Filament\Resources\LkpReportResource\Pages;

use App\Filament\Resources\LkpReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLkpReport extends ViewRecord
{
    protected static string $resource = LkpReportResource::class;

    protected \Filament\Support\Enums\Width|string|null $maxContentWidth = 'full';

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
