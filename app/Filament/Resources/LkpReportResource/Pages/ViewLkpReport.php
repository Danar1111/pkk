<?php

namespace App\Filament\Resources\LkpReportResource\Pages;

use App\Filament\Resources\LkpReportResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewLkpReport extends ViewRecord
{
    protected static string $resource = LkpReportResource::class;

    protected \Filament\Support\Enums\Width|string|null $maxContentWidth = 'full';

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('back')
                ->label('Kembali')
                ->url(static::$resource::getUrl('index'))
                ->color('gray')
                ->outlined()
                ->icon('heroicon-m-arrow-left'),
            Actions\Action::make('exportPdf')
                ->label('Export PDF')
                ->icon('heroicon-o-document-arrow-down')
                ->color('danger')
                ->action(function () {
                    $record = $this->getRecord();
                    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.lkp-report', [
                        'records' => collect([$record]),
                        'title' => 'Laporan Kegiatan PKK',
                        'date' => now()->translatedFormat('d F Y'),
                    ]);

                    return response()->streamDownload(
                        fn () => print($pdf->output()),
                        'Laporan-' . str($record->judul_laporan)->slug() . '-' . now()->format('Y-m-d') . '.pdf'
                    );
                }),
            Actions\EditAction::make()
                ->label('Ubah')
                ->icon('heroicon-m-pencil-square'),
        ];
    }
}
