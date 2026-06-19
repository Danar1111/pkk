<?php

namespace App\Filament\Widgets;

use App\Models\LkpReport;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentReportsWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    public ?int $filterMonth = null;
    public ?int $filterYear = null;

    protected $listeners = [
        'filterDashboardByMonth' => 'setFilter',
        'resetDashboardFilter' => 'resetFilter',
    ];

    public function setFilter(int $month, int $year): void
    {
        $this->filterMonth = $month;
        $this->filterYear = $year;
        $this->resetTable();
    }

    public function resetFilter(): void
    {
        $this->filterMonth = null;
        $this->filterYear = null;
        $this->resetTable();
    }

    public function table(Table $table): Table
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

        if ($this->filterMonth && $this->filterYear) {
            $query->whereMonth('created_at', $this->filterMonth)
                  ->whereYear('created_at', $this->filterYear);
        }

        return $table
            ->query(
                $query->latest()->limit(5)
            )
            ->heading('Laporan Terbaru')
            ->description('5 laporan terakhir yang masuk ke sistem.')
            ->headerActions([
                \Filament\Actions\Action::make('create')
                    ->label('Buat Laporan Baru')
                    ->url(\App\Filament\Resources\LkpReportResource::getUrl('create'))
                    ->icon('heroicon-o-plus')
                    ->button(),
                \Filament\Actions\Action::make('view_all')
                    ->label('Lihat Semua')
                    ->url(\App\Filament\Resources\LkpReportResource::getUrl('index'))
                    ->icon('heroicon-o-arrow-right')
                    ->color('gray')
                    ->outlined(),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('judul_laporan')
                    ->label('Judul Laporan')
                    ->searchable()
                    ->wrap(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pelapor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bidang.nama_bidang')
                    ->label('Bidang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('skala_lkp')
                    ->label('Skala / Wilayah')
                    ->formatStateUsing(function ($record) {
                        if ($record->skala_lkp === 'Kecamatan' && $record->kecamatan) {
                            return 'Kec. ' . $record->kecamatan->nama_kecamatan;
                        }
                        return 'Kabupaten';
                    })
                    ->badge()
                    ->color(fn ($state) => ($state === 'Kecamatan' || str_starts_with($state ?? '', 'Kec')) ? 'info' : 'success'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        'selesai' => 'success',
                        'proses' => 'warning',
                        'baru' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn ($state) => ucfirst($state ?? '')),
            ])
            ->paginated(false);
    }
}
