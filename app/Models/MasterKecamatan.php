<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterKecamatan extends Model
{
    protected $table = 'master_kecamatan';

    protected $fillable = [
        'nama_kecamatan',
    ];

    public function lkpReports(): HasMany
    {
        return $this->hasMany(LkpReport::class, 'kecamatan_id');
    }
}
