<?php

namespace App\Filament\Resources\LkpReportResource\Pages;

use App\Filament\Resources\LkpReportResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLkpReport extends CreateRecord
{
    protected static string $resource = LkpReportResource::class;

    protected \Filament\Support\Enums\Width|string|null $maxContentWidth = '5xl';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        // Pastikan status selalu terisi (default: baru)
        if (empty($data['status'])) {
            $data['status'] = 'baru';
        }

        // Pastikan kecamatan_id null jika bukan skala Kecamatan
        if (($data['skala_lkp'] ?? '') !== 'Kecamatan') {
            $data['kecamatan_id'] = null;
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
                ->label('Simpan Laporan')
                ->icon('heroicon-m-check-circle'),
            $this->getCancelFormAction()
                ->label('Batal')
                ->icon('heroicon-m-x-circle')
                ->color('gray'),
        ];
    }
}
