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

    protected static ?string $heading = 'Laporan Terbaru';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                LkpReport::query()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pelapor')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bidang.nama')
                    ->label('Bidang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kecamatan.nama')
                    ->label('Kecamatan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'selesai' => 'success',
                        'proses' => 'warning',
                        'baru' => 'info',
                        default => 'gray',
                    }),
            ])
            ->headerActions([
                \Filament\Actions\Action::make('create')
                    ->label('Buat Laporan Baru')
                    ->icon('heroicon-m-plus')
                    ->url(fn (): string => \App\Filament\Resources\LkpReportResource::getUrl('create'))
                    ->color('primary')
                    ->button(),
            ])
            ->paginated(false);
    }
}
