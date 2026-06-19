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
        $user = auth()->user();
        $query = LkpReport::query();

        if (! $user->hasRole(['Pengurus_Inti', 'Admin_Sistem', 'super_admin', 'Staf_Ahli'])) {
            $roleIds = $user->roles->pluck('id')->toArray();

            $query->where(function ($q) use ($user, $roleIds) {
                $q->where('user_id', $user->id)
                  ->orWhereHas('user', function ($q2) use ($roleIds) {
                      $q2->whereHas('roles', function ($q3) use ($roleIds) {
                          $q3->whereIn('id', $roleIds);
                      });
                  });
            });
        }

        $totalReports = (clone $query)->count();

        // Scoped for Monthly Report Card
        $monthlyQuery = clone $query;
        $activeMonth = $this->selectedMonth ?? now()->month;
        $activeYear = $this->selectedYear ?? now()->year;

        $monthlyReports = $monthlyQuery
            ->whereMonth('created_at', $activeMonth)
            ->whereYear('created_at', $activeYear)
            ->count();
        
        $totalKecamatan = MasterKecamatan::count();
        $totalBidang = MasterBidang::count();

        $months = $this->getMonths();
        $monthlyLabel = $this->selectedMonth 
            ? "Laporan Bulan " . $months[$this->selectedMonth] . " " . $this->selectedYear
            : "Laporan Bulan Ini";

        return [
            'totalReports' => number_format($totalReports),
            'monthlyReports' => number_format($monthlyReports),
            'totalKecamatan' => number_format($totalKecamatan),
            'totalBidang' => number_format($totalBidang),
            'monthlyLabel' => $monthlyLabel,
            'isFiltered' => !is_null($this->selectedMonth),
        ];
    }
}
