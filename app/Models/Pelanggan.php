<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Pelanggan extends Authenticatable
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';
    public $timestamps = false;

    protected $fillable = [
        'nama_pelanggan',
        'alamat',
        'no_telepon',
        'username_pelanggan',
        'password_pelanggan',
    ];

    protected $hidden = [
        'password_pelanggan',
    ];

    public function getAuthPassword(): string
    {
        return $this->password_pelanggan;
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_pelanggan', 'id_pelanggan');
    }
}
