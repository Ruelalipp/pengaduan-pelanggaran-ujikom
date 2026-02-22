<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Admin extends Authenticatable
{
    protected $table = 'admin';

    protected $fillable = [
        'username', 'password'
    ];

    protected $hidden = ['password'];

    /**
     * Get the aspirasi handled by this admin
     */
    public function aspirasi(): HasMany
    {
        return $this->hasMany(Aspirasi::class);
    }
}