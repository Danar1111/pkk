<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class ManajemenPengguna extends Cluster
{
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Manajemen Pengguna';
}
