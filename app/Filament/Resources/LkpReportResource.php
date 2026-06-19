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

    protected static ?string $recordTitleAttribute = 'judul_laporan';

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
                            ->required()
                            ->placeholder('Masukkan nama lengkap')
                            ->suffixAction(
                                \Filament\Actions\Action::make('autofill')
                                    ->icon('heroicon-m-user')
                                    ->tooltip('Isi dengan nama saya')
                                    ->action(fn (Set $set) => $set('nama_pelapor', auth()->user()?->name))
                            ),

                        // Row 2: Skala Laporan | Bidang / Kategori
                        Forms\Components\Select::make('skala_lkp')
                            ->label('Skala Laporan')
                            ->options([
                                'Kabupaten' => 'Kabupaten',
                                'Kecamatan' => 'Kecamatan',
                            ])
                            ->required()
                            ->placeholder('Pilih Skala')
                            ->native(false)
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

                        Forms\Components\RichEditor::make('isi_laporan')
                            ->label('Isi Laporan')
                            ->required()
                            ->placeholder('Deskripsikan detail kegiatan, hasil, dan kendala yang dihadapi...')
                            ->extraInputAttributes(['style' => 'min-height: 100px;'])
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
                Tables\Columns\Layout\Split::make([
                    Tables\Columns\ImageColumn::make('dokumentasi_foto')
                        ->disk('public')
                        ->height('150px')
                        ->width('150px')
                        ->extraImgAttributes([
                            'class' => 'object-cover rounded-xl shadow-sm',
                            'style' => 'width: 150px; height: 150px; min-width: 150px; max-width: 150px;'
                        ])
                        ->defaultImageUrl(asset('images/placeholder.png'))
                        ->limit(1)
                        ->grow(false),

                    Tables\Columns\Layout\Stack::make([
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

                        Tables\Columns\TextColumn::make('isi_laporan')
                            ->getStateUsing(fn ($record) => strip_tags($record->isi_laporan))
                            ->limit(120)
                            ->color('gray')
                            ->size('sm')
                            ->wrap(),

                        Tables\Columns\TextColumn::make('nama_pelapor')
                            ->label('Nama Pelapor')
                            ->getStateUsing(fn ($record) => $record->nama_pelapor ?: $record->user?->name)
                            ->icon('heroicon-m-user-circle')
                            ->color('gray')
                            ->size('sm'),

                        Tables\Columns\TextColumn::make('skala_lkp')
                            ->formatStateUsing(fn ($record) => $record->skala_lkp === 'Kecamatan' ? "Kec: {$record->kecamatan->nama_kecamatan}" : 'Tingkat Kabupaten')
                            ->color('info')
                            ->size('sm')
                            ->icon('heroicon-m-map-pin'),
                    ])->space(2),
                ])->extraAttributes(['class' => 'gap-6 items-start'])
            ])
            ->filters([
                Tables\Filters\Filter::make('tanggal')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Dari Tanggal')
                            ->placeholder('Pilih tanggal awal')
                            ->native(false)
                            ->displayFormat('d M Y'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Sampai Tanggal')
                            ->placeholder('Pilih tanggal akhir')
                            ->native(false)
                            ->displayFormat('d M Y'),
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

                Tables\Filters\Filter::make('skala_wilayah')
                    ->form([
                        Forms\Components\Select::make('skala_lkp')
                            ->label('Skala')
                            ->options([
                                'Kabupaten' => 'Kabupaten',
                                'Kecamatan' => 'Kecamatan',
                            ])
                            ->native(false)
                            ->live(),

                        Forms\Components\Select::make('kecamatan_id')
                            ->label('Pilih Kecamatan')
                            ->options(MasterKecamatan::pluck('nama_kecamatan', 'id'))
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->visible(fn (Get $get) => $get('skala_lkp') === 'Kecamatan'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['skala_lkp'],
                                fn (Builder $query, $skala) => $query->where('skala_lkp', $skala),
                            )
                            ->when(
                                $data['kecamatan_id'],
                                fn (Builder $query, $kecamatanId) => $query->where('kecamatan_id', $kecamatanId),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['skala_lkp'] ?? null) {
                            if ($data['skala_lkp'] === 'Kecamatan') {
                                if ($data['kecamatan_id'] ?? null) {
                                    $kecamatanName = MasterKecamatan::find($data['kecamatan_id'])?->nama_kecamatan;
                                    $indicators[] = "Skala: Kec. " . ($kecamatanName ?: '');
                                } else {
                                    $indicators[] = 'Skala: Kecamatan';
                                }
                            } else {
                                $indicators[] = 'Skala: Kabupaten';
                            }
                        }
                        return $indicators;
                    }),
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
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Grid::make(3)
                    ->columnSpanFull()
                    ->components([
                        // Kolom Kiri: Informasi dan Isi Laporan
                    \Filament\Schemas\Components\Group::make()
                        ->extraAttributes([
                            'class' => 'lg:sticky lg:top-24 lg:self-start filament-sticky-col'
                        ])
                        ->components([
                            \Filament\Schemas\Components\Section::make('Informasi Laporan')
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
                                    ])->extraAttributes(['class' => 'pb-6 mb-6 border-b border-gray-200 dark:border-white/10']),

                                    \Filament\Infolists\Components\TextEntry::make('judul_laporan')
                                        ->label('Judul Laporan')
                                        ->weight(FontWeight::Bold)
                                        ->size('lg'),

                                    \Filament\Infolists\Components\TextEntry::make('isi_laporan')
                                        ->label('Isi Laporan')
                                        ->html()
                                        ->prose(),
                                ])
                        ])->columnSpan(['sm' => 3, 'lg' => 2]),

                    // Kolom Kanan: Dokumentasi Kegiatan
                    \Filament\Schemas\Components\Group::make()->components([
                        \Filament\Schemas\Components\Section::make('Dokumentasi Kegiatan')
                            ->components([
                                \Filament\Infolists\Components\ImageEntry::make('dokumentasi_foto')
                                    ->disk('public')
                                    ->hiddenLabel()
                                    ->extraImgAttributes([
                                        'class' => 'rounded-xl shadow-sm mb-4 transition duration-200 hover:scale-[1.02] cursor-pointer ring-1 ring-gray-200 dark:ring-gray-700',
                                        'style' => 'width: 100%; height: auto; object-fit: contain;',
                                        'title' => 'Klik untuk memperbesar / mengunduh gambar',
                                    ])
                                    ->url(fn ($state) => \Illuminate\Support\Facades\Storage::disk('public')->url($state))
                                    ->openUrlInNewTab()
                                    ->limit(20), // Limit diperbanyak
                            ])
                    ])->columnSpan(['sm' => 3, 'lg' => 1])
                    ->visible(fn ($record) => !empty($record->dokumentasi_foto)),
                ]),
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
        $user = auth()->user();

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
