<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LkpReport extends Model
{
    protected $fillable = [
        'user_id',
        'tanggal_laporan',
        'nama_pelapor',
        'skala_lkp',
        'kecamatan_id',
        'bidang_id',
        'judul_laporan',
        'isi_laporan',
        'dokumentasi_foto',
        'status',
    ];

    protected $casts = [
        'dokumentasi_foto' => 'array',
        'tanggal_laporan' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kecamatan(): BelongsTo
    {
        return $this->belongsTo(MasterKecamatan::class, 'kecamatan_id');
    }

    public function bidang(): BelongsTo
    {
        return $this->belongsTo(MasterBidang::class, 'bidang_id');
    }

    protected static function booted()
    {
        // Hapus file dari storage jika ada foto yang dihapus saat update
        static::updated(function ($report) {
            $original = $report->getOriginal('dokumentasi_foto');
            $originalPhotos = is_string($original) ? (json_decode($original, true) ?? []) : ($original ?? []);
            $currentPhotos = $report->dokumentasi_foto ?? [];
            
            $removedPhotos = array_diff($originalPhotos, $currentPhotos);
            
            foreach ($removedPhotos as $photo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($photo);
            }
        });

        // Hapus semua file dari storage saat laporan dihapus permanen
        static::deleted(function ($report) {
            $photos = $report->dokumentasi_foto ?? [];
            foreach ($photos as $photo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($photo);
            }
        });
    }
}
