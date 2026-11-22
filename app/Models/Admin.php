<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
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

    public function getAuthPassword(): string
    {
        return $this->password_admin;
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_admin', 'id_admin');
    }
}
