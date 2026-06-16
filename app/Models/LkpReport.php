<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LkpReport extends Model
{
    protected $fillable = [
        'user_id',
        'skala_lkp',
        'kecamatan_id',
        'bidang_id',
        'isi_laporan',
        'dokumentasi_foto',
    ];

    protected $casts = [
        'dokumentasi_foto' => 'array',
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
}
