<?php

namespace App\Filament\Widgets;

use App\Models\LkpReport;
use App\Models\MasterBidang;
use App\Models\MasterKecamatan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        $totalReports = LkpReport::count();
        $monthlyReports = LkpReport::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $totalKecamatan = MasterKecamatan::count();
        $totalBidang = MasterBidang::count();

        return [
            Stat::make('Total Laporan', number_format($totalReports))
                ->description('Seluruh laporan')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),
            Stat::make('Laporan Bulan Ini', number_format($monthlyReports))
                ->description('Bulan ' . now()->translatedFormat('F'))
                ->descriptionIcon('heroicon-m-calendar')
                ->color('success'),
            Stat::make('Total Kecamatan', number_format($totalKecamatan))
                ->description('Kecamatan terdaftar')
                ->descriptionIcon('heroicon-m-map-pin')
                ->color('info'),
            Stat::make('Total Bidang', number_format($totalBidang))
                ->description('Bidang aktif')
                ->descriptionIcon('heroicon-m-squares-2x2')
                ->color('warning'),
        ];
    }
}
