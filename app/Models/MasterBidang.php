<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterBidang extends Model
{
    protected $table = 'master_bidang';

    protected $fillable = [
        'nama_bidang',
    ];

    public function lkpReports(): HasMany
    {
        return $this->hasMany(LkpReport::class, 'bidang_id');
    }
}
