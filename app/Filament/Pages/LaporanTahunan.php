<?php

namespace App\Filament\Pages;

use App\Models\AnnualReportSetting;
use Filament\Pages\Page;

class LaporanTahunan extends Page
{
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-document-duplicate';

    protected static ?string $navigationLabel = 'Laporan Tahunan';

    protected static ?string $title = 'Laporan Tahunan';

    protected static ?int $navigationSort = 3;

    protected string $view = 'filament.pages.laporan-tahunan';

    public static function getNavigationUrl(): string
    {
        return AnnualReportSetting::getUrl();
    }

    public static function getNavigationTarget(): ?string
    {
        return '_blank';
    }

    public static function canAccess(): bool
    {
        $allowedRoles = AnnualReportSetting::getAllowedRoles();
        return auth()->user()?->hasRole($allowedRoles) ?? false;
    }
}
