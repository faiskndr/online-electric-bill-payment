<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Authenticatable
{
    use HasFactory;
    
    public $timestamps = false;
    protected $guarded = ['id_pelanggan'];
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';

    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'id_tarif', 'id_tarif');
    }

    public function penggunaan()
    {
        return $this->hasMany(Penggunaan::class, 'id_pelanggan', 'id_pelanggan');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_pelanggan', 'id_pelanggan');
    }
}
