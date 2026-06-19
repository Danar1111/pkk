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

    public ?int $selectedMonth = null;
    public ?int $selectedYear = null;
    public bool $showFilterModal = false;
    public bool $showDetailsModal = false;
    public ?int $tempMonth = null;
    public ?int $tempYear = null;

    public function openFilter(): void
    {
        $this->tempMonth = $this->selectedMonth ?? now()->month;
        $this->tempYear = $this->selectedYear ?? now()->year;
        $this->showFilterModal = true;
    }

    public function closeFilter(): void
    {
        $this->showFilterModal = false;
    }

    public function openDetails(): void
    {
        $this->showDetailsModal = true;
    }

    public function closeDetails(): void
    {
        $this->showDetailsModal = false;
    }

    public function applyFilter(): void
    {
        $this->selectedMonth = (int) $this->tempMonth;
        $this->selectedYear = (int) $this->tempYear;
        $this->showFilterModal = false;

        $this->dispatch('filterDashboardByMonth', month: $this->selectedMonth, year: $this->selectedYear);
    }

    public function resetFilter(): void
    {
        $this->selectedMonth = null;
        $this->selectedYear = null;
        $this->showFilterModal = false;

        $this->dispatch('resetDashboardFilter');
    }

    public function getMonths(): array
    {
        return [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
    }

    protected function getViewData(): array
    {
        $query = LkpReport::query();

        $totalReports = (clone $query)->count();

        // Scoped for Monthly Report Card
        $activeMonth = $this->selectedMonth ?? now()->month;
        $activeYear = $this->selectedYear ?? now()->year;

        $monthlyReports = (clone $query)
            ->whereMonth('tanggal_laporan', $activeMonth)
            ->whereYear('tanggal_laporan', $activeYear)
            ->count();
        
        $totalKecamatan = MasterKecamatan::count();

        // Load all Bidang and check if they have reported in the active month/year
        $bidangList = MasterBidang::with(['lkpReports' => function ($q) use ($activeMonth, $activeYear) {
            $q->whereMonth('tanggal_laporan', $activeMonth)
              ->whereYear('tanggal_laporan', $activeYear);
        }])->get();

        $reportedBidangCount = $bidangList->filter(fn ($b) => $b->lkpReports->isNotEmpty())->count();
        $totalBidangCount = $bidangList->count();

        $months = $this->getMonths();
        $monthlyLabel = $this->selectedMonth 
            ? "Laporan Bulan " . $months[$this->selectedMonth] . " " . $this->selectedYear
            : "Laporan Bulan Ini";

        $bidangLabel = $this->selectedMonth
            ? "Bidang Terlapor (" . $months[$this->selectedMonth] . " " . $this->selectedYear . ")"
            : "Bidang Terlapor Bulan Ini";

        return [
            'totalReports' => number_format($totalReports),
            'monthlyReports' => number_format($monthlyReports),
            'totalKecamatan' => number_format($totalKecamatan),
            'reportedBidangCount' => $reportedBidangCount,
            'totalBidangCount' => $totalBidangCount,
            'bidangLabel' => $bidangLabel,
            'bidangList' => $bidangList,
            'activeMonthLabel' => $this->selectedMonth ? $months[$this->selectedMonth] . " " . $this->selectedYear : $months[now()->month] . " " . now()->year,
            'monthlyLabel' => $monthlyLabel,
            'isFiltered' => !is_null($this->selectedMonth),
            'activeMonth' => $activeMonth,
            'activeYear' => $activeYear,
        ];
    }
}
