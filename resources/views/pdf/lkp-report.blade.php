<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
            color: #1e293b;
            line-height: 1.6;
            padding: 30px 30px 50px 30px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #1E88E5;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .header h1 {
            font-size: 16px;
            color: #1E88E5;
            margin-bottom: 4px;
            font-weight: bold;
        }
        .header p {
            font-size: 9px;
            color: #64748B;
        }
        .report-title {
            font-size: 14px;
            font-weight: bold;
            color: #0f172a;
            margin-top: 10px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }
        .report-section-title {
            font-size: 11px;
            font-weight: bold;
            color: #1E88E5;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 4px;
            margin-top: 15px;
            margin-bottom: 8px;
        }
        .report-content {
            font-size: 10px;
            color: #334155;
            margin-top: 5px;
            text-align: justify;
        }
        .report-content p {
            margin-bottom: 8px;
        }
        .report-content ul, .report-content ol {
            margin-left: 20px;
            margin-bottom: 8px;
        }
        .report-content li {
            margin-bottom: 3px;
        }
        .footer {
            position: fixed;
            bottom: 20px;
            left: 30px;
            right: 30px;
            font-size: 8px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            padding-top: 8px;
        }
        .footer .page-counter:after {
            content: counter(page);
        }
    </style>
</head>
<body>
    @if($records->count() > 0)
        @foreach($records as $index => $record)
            <div class="report-document" style="{{ !$loop->last ? 'page-break-after: always;' : '' }}">
                <!-- Kop Laporan -->
                <div class="header">
                    <h1>LAPORAN KEGIATAN PKK</h1>
                    <p>Sistem Pelaporan Kegiatan Masyarakat - Kabupaten/Kecamatan</p>
                </div>

                <!-- Judul Laporan -->
                <div class="report-title">
                    {{ $record->judul_laporan }}
                </div>

                <!-- Informasi Laporan -->
                <table style="width: 100%; border: none; margin-bottom: 15px; background-color: #f8fafc; border-radius: 6px; padding: 10px; border-collapse: collapse;">
                    <tr>
                        <td style="width: 25%; font-weight: bold; border: none; padding: 4px 0; color: #475569; font-size: 9px;">Tanggal Laporan</td>
                        <td style="width: 75%; border: none; padding: 4px 0; color: #0F172A; font-size: 9px;">: {{ $record->tanggal_laporan ? $record->tanggal_laporan->translatedFormat('l, d F Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; border: none; padding: 4px 0; color: #475569; font-size: 9px;">Nama Pelapor</td>
                        <td style="border: none; padding: 4px 0; color: #0F172A; font-size: 9px;">: {{ $record->nama_pelapor ?: ($record->user->name ?? '-') }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; border: none; padding: 4px 0; color: #475569; font-size: 9px;">Bidang / Kategori</td>
                        <td style="border: none; padding: 4px 0; color: #0F172A; font-size: 9px;">: {{ $record->bidang->nama_bidang ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; border: none; padding: 4px 0; color: #475569; font-size: 9px;">Skala Wilayah</td>
                        <td style="border: none; padding: 4px 0; color: #0F172A; font-size: 9px;">: 
                            {{ $record->skala_lkp }}
                            @if($record->skala_lkp === 'Kecamatan' && $record->kecamatan)
                                (Kec. {{ $record->kecamatan->nama_kecamatan }})
                            @endif
                        </td>
                    </tr>
                </table>

                <!-- Isi Laporan -->
                <div class="report-section-title">DESKRIPSI KEGIATAN</div>
                <div class="report-content">
                    {!! $record->isi_laporan !!}
                </div>

                <!-- Foto Kegiatan -->
                @if(!empty($record->dokumentasi_foto))
                    <div style="page-break-inside: avoid;">
                        <div class="report-section-title">LAMPIRAN DOKUMENTASI FOTO</div>
                        
                        @if(count($record->dokumentasi_foto) === 1)
                            <!-- Satu Foto: Tampilkan besar dan rata kiri (sejajar margin) -->
                            @php
                                $photo = $record->dokumentasi_foto[0];
                                $absolutePath = storage_path('app/public/' . $photo);
                            @endphp
                            <div style="text-align: left; margin-top: 10px;">
                                @if(file_exists($absolutePath))
                                    <img src="{{ $absolutePath }}" style="max-width: 100%; max-height: 380px; width: auto; height: auto; border-radius: 8px; border: 1px solid #cbd5e1;" />
                                @else
                                    <div style="max-width: 300px; height: 200px; border-radius: 8px; border: 1px dashed #cbd5e1; background-color: #f8fafc; line-height: 200px; color: #94a3b8; font-size: 9px; text-align: center;">
                                        Foto tidak ditemukan di server
                                    </div>
                                @endif
                            </div>
                        @else
                            <!-- Lebih dari Satu Foto: Flow Alami Tanpa Pemaksaan Baris Baru -->
                            <div style="margin-top: 10px; text-align: left;">
                                @foreach($record->dokumentasi_foto as $photo)
                                    @php
                                        $absolutePath = storage_path('app/public/' . $photo);
                                    @endphp
                                    @if(file_exists($absolutePath))
                                        <div style="display: inline-block; margin-right: 15px; margin-bottom: 15px; vertical-align: top;">
                                            <img src="{{ $absolutePath }}" style="max-width: 320px; max-height: 250px; width: auto; height: auto; border-radius: 8px; border: 1px solid #cbd5e1;" />
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        @endforeach
    @else
        <div style="text-align: center; padding: 50px; color: #94a3b8; font-style: italic; font-size: 12px;">
            Tidak ada data laporan untuk diekspor.
        </div>
    @endif

    <div class="footer">
        <table style="width: 100%; border: none; border-collapse: collapse; margin: 0; padding: 0;">
            <tr>
                <td style="width: 50%; border: none; padding: 0; text-align: left; color: #94a3b8; font-size: 8px; font-family: inherit;">
                    Dicetak pada: {{ \Illuminate\Support\Carbon::now()->translatedFormat('l, d F Y H:i') }}
                </td>
                <td style="width: 50%; border: none; padding: 0; text-align: right; color: #94a3b8; font-size: 8px; font-family: inherit;">
                    Halaman <span class="page-counter"></span>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
