<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'username',
        'password',
    ];

    // Mengatur hidden fields
    protected $hidden = [
        'password',
    ];
}
