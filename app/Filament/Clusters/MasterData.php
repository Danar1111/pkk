<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class MasterData extends Cluster
{
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-circle-stack';

    protected static ?string $navigationLabel = 'Master Data';
}
