<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnnualReportSettingResource\Pages;
use App\Models\AnnualReportSetting;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Spatie\Permission\Models\Role;

class AnnualReportSettingResource extends Resource
{
    protected static ?string $model = AnnualReportSetting::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $cluster = \App\Filament\Clusters\MasterData::class;

    protected static ?string $navigationLabel = 'Laporan Tahunan';

    protected static ?string $modelLabel = 'Pengaturan Laporan Tahunan';

    protected static ?string $pluralModelLabel = 'Pengaturan Laporan Tahunan';

    protected static ?int $navigationSort = 3;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole(['super_admin', 'Admin_Sistem']) ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Pengaturan Link Laporan Tahunan')
                    ->description('Kelola link spreadsheet Laporan Tahunan dan atur siapa saja yang dapat mengaksesnya.')
                    ->icon('heroicon-o-link')
                    ->schema([
                        Forms\Components\TextInput::make('url')
                            ->label('Link Spreadsheet / URL Halaman')
                            ->url()
                            ->required()
                            ->placeholder('Masukkan URL lengkap (contoh: https://docs.google.com/spreadsheets/...)')
                            ->columnSpanFull(),

                        Forms\Components\CheckboxList::make('allowed_roles')
                            ->label('Role yang Diizinkan Mengakses')
                            ->options(Role::pluck('name', 'name')->toArray())
                            ->columns(2)
                            ->required()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('url')
                    ->label('URL')
                    ->limit(50),
                Tables\Columns\TextColumn::make('allowed_roles')
                    ->label('Role yang Diizinkan')
                    ->badge()
                    ->separator(','),
            ])
            ->actions([
                \Filament\Actions\EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnnualReportSettings::route('/'),
            'edit' => Pages\EditAnnualReportSetting::route('/{record}/edit'),
        ];
    }
}
