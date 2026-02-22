<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelaku extends Model
{
    protected $table = 'pelaku';

    protected $fillable = [
        'type'
    ];

    /**
     * Get the input aspirasi for this pelaku
     */
    public function inputAspirasi(): HasMany
    {
        return $this->hasMany(InputAspirasi::class);
    }
}
