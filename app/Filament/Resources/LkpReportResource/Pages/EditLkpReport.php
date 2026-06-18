<?php

namespace App\Filament\Resources\LkpReportResource\Pages;

use App\Filament\Resources\LkpReportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLkpReport extends EditRecord
{
    protected static string $resource = LkpReportResource::class;

    protected \Filament\Support\Enums\Width|string|null $maxContentWidth = '5xl';

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Sync: pastikan kecamatan_id null jika skala bukan Kecamatan
        if (($data['skala_lkp'] ?? '') !== 'Kecamatan') {
            $data['kecamatan_id'] = null;
        }

        return $data;
    }

    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction()
                ->label('Simpan Perubahan')
                ->icon('heroicon-m-check-circle'),
            $this->getCancelFormAction()
                ->label('Batal')
                ->icon('heroicon-m-x-circle')
                ->color('gray'),
        ];
    }
}
