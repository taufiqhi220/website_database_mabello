<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins'; // Jika nama tabelnya adalah 'admins'

    protected $fillable = [
        'id_user',
        'nama',
        'password',
        'posisi',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
