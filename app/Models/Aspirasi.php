<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Aspirasi extends Model
{
    protected $table = 'aspirasi';

    protected $fillable = [
        'input_aspirasi_id',
        'admin_id',
        'status',
        'gambar',
        'feedback',
        'is_archived'
    ];

    /**
     * Get the input aspirasi for this aspirasi
     */
    public function inputAspirasi(): BelongsTo
    {
        return $this->belongsTo(InputAspirasi::class);
    }

    /**
     * Get the admin that handles this aspirasi
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'Menunggu' => 'yellow',
            'Proses' => 'blue',
            'Selesai' => 'green',
            default => 'gray'
        };
    }
}
