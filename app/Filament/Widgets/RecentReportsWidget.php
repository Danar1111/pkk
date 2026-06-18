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

    public function table(Table $table): Table
    {
        return $table
            ->query(
                LkpReport::query()->latest()->limit(5)
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
