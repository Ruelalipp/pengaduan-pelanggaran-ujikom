<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class InputAspirasi extends Model
{
    protected $table = 'input_aspirasi';

    protected $fillable = [
        'siswa_id',
        'pelaku_id',
        'keterangan',
        'gambar'
    ];

    /**
     * Get the siswa that submitted this input aspirasi
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }

    /**
     * Get the pelaku for this input aspirasi  
     */
    public function pelaku(): BelongsTo
    {
        return $this->belongsTo(Pelaku::class);
    }

    /**
     * Get the aspirasi record for this input
     */
    public function aspirasi(): HasOne
    {
        return $this->hasOne(Aspirasi::class);
    }
}
