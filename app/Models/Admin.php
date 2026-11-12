<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    public $timestamps = false;
    protected $fillable = [
        'nama_admin',
        'username_admin',
        'password_admin',
        'no_telepon',
    ];
    protected $hidden = [
        'password_admin',
    ];
    // relasi: satu admin bisa memiliki banyak transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_admin', 'id_admin');
    }
}
