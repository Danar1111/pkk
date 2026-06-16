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
            color: #1a1a1a;
            line-height: 1.5;
        }
        .header {
            text-align: center;
            border-bottom: 3px double #1E88E5;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 18px;
            color: #1E88E5;
            margin-bottom: 4px;
        }
        .header p {
            font-size: 11px;
            color: #64748B;
        }
        .meta {
            text-align: right;
            font-size: 9px;
            color: #64748B;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background-color: #1E88E5;
            color: #ffffff;
            padding: 8px 6px;
            text-align: left;
            font-size: 10px;
            font-weight: 600;
        }
        td {
            padding: 7px 6px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 9px;
            vertical-align: top;
        }
        tr:nth-child(even) {
            background-color: #f8fafc;
        }
        tr:hover {
            background-color: #eff6ff;
        }
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 9999px;
            font-size: 8px;
            font-weight: 600;
        }
        .badge-kabupaten {
            background-color: #dcfce7;
            color: #166534;
        }
        .badge-kecamatan {
            background-color: #dbeafe;
            color: #1e40af;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 8px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            padding-top: 8px;
        }
        .no-data {
            text-align: center;
            padding: 30px;
            color: #94a3b8;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <p>Sistem Pelaporan Kegiatan Masyarakat</p>
    </div>

    <div class="meta">
        Dicetak pada: {{ $date }} | Total: {{ $records->count() }} laporan
    </div>

    @if($records->count() > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 4%;">No</th>
                    <th style="width: 10%;">Tanggal</th>
                    <th style="width: 14%;">Penulis</th>
                    <th style="width: 14%;">Bidang</th>
                    <th style="width: 10%;">Skala</th>
                    <th style="width: 12%;">Kecamatan</th>
                    <th style="width: 36%;">Isi Laporan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $index => $record)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $record->created_at->format('d/m/Y') }}</td>
                        <td>{{ $record->user->name ?? '-' }}</td>
                        <td>{{ $record->bidang->nama_bidang ?? '-' }}</td>
                        <td>
                            <span class="badge badge-{{ strtolower($record->skala_lkp) }}">
                                {{ $record->skala_lkp }}
                            </span>
                        </td>
                        <td>{{ $record->kecamatan->nama_kecamatan ?? '-' }}</td>
                        <td>{!! Str::limit(strip_tags($record->isi_laporan), 120) !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            Tidak ada data laporan untuk ditampilkan.
        </div>
    @endif

    <div class="footer">
        &copy; {{ date('Y') }} LKP PKK — Dokumen ini dihasilkan secara otomatis oleh sistem.
    </div>
</body>
</html>
