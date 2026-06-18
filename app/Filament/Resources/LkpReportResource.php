<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LkpReportResource\Pages;
use App\Models\LkpReport;
use App\Models\MasterBidang;
use App\Models\MasterKecamatan;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components as InfolistComponents;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\Layout\Split;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Blade;

class LkpReportResource extends Resource
{
    protected static ?string $model = LkpReport::class;

    protected static ?string $recordTitleAttribute = 'isi_laporan';

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Laporan Kegiatan';

    protected static ?string $modelLabel = 'Laporan Kegiatan';

    protected static ?string $pluralModelLabel = 'Laporan Kegiatan';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // ── Section 1: Informasi Umum ──────────────────────────────
                \Filament\Schemas\Components\Section::make('Informasi Umum')
                    ->description('Isi data dasar laporan kegiatan PKK.')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        // Hidden fields – auto-managed
                        Forms\Components\Hidden::make('user_id')
                            ->default(auth()->id()),

                        Forms\Components\Hidden::make('status')
                            ->default('baru'),

                        // Row 1: Tanggal Laporan | Nama Pelapor
                        Forms\Components\DatePicker::make('created_at')
                            ->label('Tanggal Laporan')
                            ->default(now())
                            ->required()
                            ->native(false)
                            ->displayFormat('d/m/Y')
                            ->placeholder('dd/mm/yyyy'),

                        Forms\Components\TextInput::make('nama_pelapor')
                            ->label('Nama Pelapor')
                            ->default(fn () => auth()->user()?->name)
                            ->readOnly()
                            ->required()
                            ->dehydrated(false)
                            ->placeholder('Masukkan nama lengkap'),

                        // Row 2: Skala Laporan | Bidang / Kategori
                        Forms\Components\Select::make('skala_lkp')
                            ->label('Skala Laporan')
                            ->options([
                                'Kabupaten' => 'Kabupaten',
                                'Kecamatan' => 'Kecamatan',
                            ])
                            ->required()
                            ->placeholder('Pilih Skala')
                            ->live()
                            ->afterStateUpdated(function ($state, Set $set) {
                                // Bersihkan kecamatan jika skala bukan Kecamatan
                                if ($state !== 'Kecamatan') {
                                    $set('kecamatan_id', null);
                                }
                            }),

                        Forms\Components\Select::make('bidang_id')
                            ->label('Bidang / Kategori')
                            ->options(MasterBidang::pluck('nama_bidang', 'id'))
                            ->searchable()
                            ->preload()
                            ->required()
                            ->placeholder('Pilih Kategori'),

                        // Row 3 (kondisional): Muncul saat Skala = Kecamatan
                        Forms\Components\Select::make('kecamatan_id')
                            ->label('Kecamatan')
                            ->options(MasterKecamatan::pluck('nama_kecamatan', 'id'))
                            ->searchable()
                            ->preload()
                            ->placeholder('Pilih Kecamatan')
                            ->required(fn (Get $get): bool => $get('skala_lkp') === 'Kecamatan')
                            ->visible(fn (Get $get): bool => $get('skala_lkp') === 'Kecamatan')
                            ->columnSpanFull()
                            ->extraAttributes([
                                'x-transition:enter'       => 'transition ease-out duration-300',
                                'x-transition:enter-start' => 'opacity-0 -translate-y-3 scale-98',
                                'x-transition:enter-end'   => 'opacity-100 translate-y-0 scale-100',
                                'x-transition:leave'       => 'transition ease-in duration-200',
                                'x-transition:leave-start' => 'opacity-100 translate-y-0 scale-100',
                                'x-transition:leave-end'   => 'opacity-0 -translate-y-3 scale-98',
                            ]),
                    ])
                    ->columns(2),

                // ── Section 2: Detail Laporan ───────────────────────────────
                \Filament\Schemas\Components\Section::make('Detail Laporan')
                    ->description('Isi judul, konten, dan lampiran foto kegiatan.')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Forms\Components\TextInput::make('judul_laporan')
                            ->label('Judul Laporan')
                            ->required()
                            ->placeholder('Contoh: Kegiatan Posyandu Mawar Merah')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('isi_laporan')
                            ->label('Isi Laporan')
                            ->required()
                            ->placeholder('Deskripsikan detail kegiatan, hasil, dan kendala yang dihadapi...')
                            ->rows(6)
                            ->autosize()
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('dokumentasi_foto')
                            ->label('Lampiran Foto')
                            ->image()
                            ->multiple()
                            ->reorderable()
                            ->appendFiles()
                            ->directory('lkp-photos')
                            ->disk('public')
                            ->maxFiles(5)
                            ->maxSize(5120)
                            ->panelLayout('grid')
                            ->imageResizeMode('cover')
                            ->imageResizeTargetWidth('1080')
                            ->imageResizeTargetHeight('1080')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->helperText('Seret & lepas foto, atau klik untuk memilih (Maks. 5 foto, 5MB/foto).')
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Stack::make([
                    Tables\Columns\ImageColumn::make('dokumentasi_foto')
                        ->height('200px')
                        ->width('100%')
                        ->extraImgAttributes([
                            'class' => 'object-cover rounded-t-xl w-full h-full',
                        ])
                        ->limit(1),

                    Stack::make([
                        Tables\Columns\TextColumn::make('bidang.nama_bidang')
                            ->badge()
                            ->color('primary')
                            ->weight(FontWeight::Bold),

                        Tables\Columns\TextColumn::make('judul_laporan')
                            ->weight(FontWeight::Bold)
                            ->size('lg')
                            ->searchable()
                            ->sortable(),

                        Tables\Columns\TextColumn::make('created_at')
                            ->dateTime('l, d F Y')
                            ->color('gray')
                            ->size('sm'),

                        Tables\Columns\TextColumn::make('user.name')
                            ->icon('heroicon-m-user-circle')
                            ->color('gray')
                            ->size('sm'),

                        Tables\Columns\TextColumn::make('skala_lkp')
                            ->formatStateUsing(fn ($record) => $record->skala_lkp === 'Kecamatan' ? "Kec: {$record->kecamatan->nama_kecamatan}" : 'Tingkat Kabupaten')
                            ->color('info')
                            ->size('sm')
                            ->icon('heroicon-m-map-pin'),
                    ])->space(2)->extraAttributes(['class' => 'p-4']),
                ])
            ])
            ->filters([
                Tables\Filters\Filter::make('tanggal')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Dari Tanggal')
                            ->placeholder('Pilih tanggal awal'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Sampai Tanggal')
                            ->placeholder('Pilih tanggal akhir'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators[] = Tables\Filters\Indicator::make('Dari: ' . \Carbon\Carbon::parse($data['created_from'])->format('d M Y'))
                                ->removeField('created_from');
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators[] = Tables\Filters\Indicator::make('Sampai: ' . \Carbon\Carbon::parse($data['created_until'])->format('d M Y'))
                                ->removeField('created_until');
                        }
                        return $indicators;
                    }),

                Tables\Filters\SelectFilter::make('bidang_id')
                    ->label('Bidang')
                    ->relationship('bidang', 'nama_bidang')
                    ->searchable()
                    ->preload(),

                Tables\Filters\SelectFilter::make('skala_lkp')
                    ->label('Skala')
                    ->options([
                        'Kabupaten' => 'Kabupaten',
                        'Kecamatan' => 'Kecamatan',
                    ]),
            ])
            ->actions([
                \Filament\Actions\ViewAction::make(),
                \Filament\Actions\EditAction::make(),
                \Filament\Actions\DeleteAction::make(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exports([
                        ExcelExport::make('laporan_lkp')
                            ->withFilename(fn () => 'Laporan-LKP-' . now()->format('Y-m-d'))
                            ->fromTable()
                            ->withColumns([
                                Column::make('created_at')->heading('Tanggal'),
                                Column::make('user.name')->heading('Penulis'),
                                Column::make('bidang.nama_bidang')->heading('Bidang'),
                                Column::make('skala_lkp')->heading('Skala'),
                                Column::make('kecamatan.nama_kecamatan')->heading('Kecamatan'),
                                Column::make('isi_laporan')->heading('Isi Laporan'),
                            ]),
                    ])
                    ->label('Export Excel')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success'),

                \Filament\Actions\Action::make('exportPdf')
                    ->label('Export PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('danger')
                    ->action(function () {
                        $records = static::getEloquentQuery()
                            ->with(['user', 'bidang', 'kecamatan'])
                            ->latest()
                            ->get();

                        $pdf = Pdf::loadView('pdf.lkp-report', [
                            'records' => $records,
                            'title' => 'Laporan LKP PKK',
                            'date' => now()->format('d F Y'),
                        ]);

                        return response()->streamDownload(
                            fn () => print($pdf->output()),
                            'Laporan-LKP-' . now()->format('Y-m-d') . '.pdf'
                        );
                    }),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exports([
                            ExcelExport::make()
                                ->withFilename(fn () => 'Laporan-LKP-Selected-' . now()->format('Y-m-d'))
                                ->fromTable()
                        ]),
                ]),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Informasi Kegiatan')
                    ->icon('heroicon-o-information-circle')
                    ->components([
                        \Filament\Schemas\Components\Grid::make(2)->components([
                            \Filament\Infolists\Components\TextEntry::make('bidang.nama_bidang')
                                ->label('Program Pokok / Bidang')
                                ->badge()
                                ->color('primary'),
                            \Filament\Infolists\Components\TextEntry::make('created_at')
                                ->label('Tanggal Pelaksanaan')
                                ->dateTime('l, d F Y')
                                ->icon('heroicon-o-calendar'),
                            \Filament\Infolists\Components\TextEntry::make('user.name')
                                ->label('Dilaporkan Oleh')
                                ->icon('heroicon-o-user'),
                            \Filament\Infolists\Components\TextEntry::make('skala_lkp')
                                ->label('Skala / Tingkat')
                                ->formatStateUsing(fn ($record) => $record->skala_lkp === 'Kecamatan' ? "Kec. {$record->kecamatan->nama_kecamatan}" : 'Kabupaten')
                                ->icon('heroicon-o-map-pin'),
                        ]),
                    ]),

                \Filament\Schemas\Components\Section::make('Detail Laporan')
                    ->icon('heroicon-o-document-text')
                    ->components([
                        \Filament\Infolists\Components\TextEntry::make('judul_laporan')
                            ->weight(FontWeight::Bold)
                            ->size('lg')
                            ->hiddenLabel(),

                        \Filament\Infolists\Components\TextEntry::make('isi_laporan')
                            ->hiddenLabel()
                            ->html()
                            ->prose(),
                    ]),

                \Filament\Schemas\Components\Section::make('Dokumentasi Kegiatan')
                    ->icon('heroicon-o-camera')
                    ->components([
                        \Filament\Infolists\Components\ImageEntry::make('dokumentasi_foto')
                            ->hiddenLabel()
                            ->size('100%')
                            ->extraImgAttributes([
                                'class' => 'rounded-xl shadow-sm max-h-[400px] object-cover w-full',
                            ])
                            ->stacked()
                            ->limit(5),
                    ])
                    ->visible(fn ($record) => !empty($record->dokumentasi_foto)),
            ]);
    }

    /**
     * Scope the query based on user role.
     * Normal users see only their own reports.
     * Pengurus_Inti can see all reports.
     */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (! auth()->user()->hasRole(['Pengurus_Inti', 'Admin_Sistem', 'super_admin'])) {
            $query->where('user_id', auth()->id());
        }

        return $query;
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLkpReports::route('/'),
            'create' => Pages\CreateLkpReport::route('/create'),
            'view' => Pages\ViewLkpReport::route('/{record}'),
            'edit' => Pages\EditLkpReport::route('/{record}/edit'),
        ];
    }
}
