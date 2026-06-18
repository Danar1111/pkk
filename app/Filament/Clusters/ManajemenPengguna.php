<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class ManajemenPengguna extends Cluster
{
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Manajemen Pengguna';

    protected static ?int $navigationSort = 5;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole(['super_admin', 'Admin_Sistem']) ?? false;
    }
}
