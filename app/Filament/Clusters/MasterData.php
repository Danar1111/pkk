<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class MasterData extends Cluster
{
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-circle-stack';

    protected static ?string $navigationLabel = 'Master Data';

    protected static ?int $navigationSort = 4;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole(['super_admin', 'Admin_Sistem']) ?? false;
    }
}
