<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
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
    // Relasi: satu pelanggan bisa memiliki banyak transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_pelanggan', 'id_pelanggan');
    }
}
