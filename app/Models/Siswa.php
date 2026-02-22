<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Authenticatable
{
    protected $table = 'siswa';

    protected $fillable = [
        'nis', 'kelas', 'username', 'password'
    ];

    protected $hidden = ['password'];

    /**
     * Get the input aspirasi submitted by this siswa
     */
    public function inputAspirasi(): HasMany
    {
        return $this->hasMany(InputAspirasi::class);
    }
}