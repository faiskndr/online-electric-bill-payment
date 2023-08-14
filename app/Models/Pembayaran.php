<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'pembayaran';
    protected $guarded = ['id_pembayaran'];
    protected $primaryKey = 'id_pembayaran';

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan','id_pelanggan');
    }

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'id_tagihan', 'id_tagihan');
    }
}
