<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'db_user'; // Nama tabel di database
    protected $primaryKey = 'id_user'; // Primary key
    public $incrementing = false; // Jika primary key bukan auto-increment
    protected $keyType = 'string'; // Tipe primary key
    public $timestamps = false; // Nonaktifkan timestamp jika tabel tidak menggunakannya

    protected $fillable = [
        'id_user',
        'nama',
        'password',
        'posisi',
        'status',
    ];

    /**
     * Atribut yang disembunyikan dari serialisasi (JSON/array).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting otomatis: password akan di-hash secara otomatis saat di-set.
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // User.php
    public function produkKeluar()
    {
        return $this->hasMany(ProdukMasukKeluar::class, 'distribution_center', 'id_user');
    }

}