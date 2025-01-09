<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cookiemaping extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'userid',
        'cookie',
    ];
}
