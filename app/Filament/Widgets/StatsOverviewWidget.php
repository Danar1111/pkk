<?php

namespace App\Filament\Widgets;

use App\Models\LkpReport;
use App\Models\MasterBidang;
use App\Models\MasterKecamatan;
use Filament\Widgets\Widget;

class StatsOverviewWidget extends Widget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected string $view = 'filament.widgets.stats-overview';

    protected function getViewData(): array
    {
        $totalReports = LkpReport::count();
        $monthlyReports = LkpReport::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $totalKecamatan = MasterKecamatan::count();
        $totalBidang = MasterBidang::count();

        return [
            'totalReports' => number_format($totalReports),
            'monthlyReports' => number_format($monthlyReports),
            'totalKecamatan' => number_format($totalKecamatan),
            'totalBidang' => number_format($totalBidang),
        ];
    }
}
