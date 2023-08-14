<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use HasFactory;

    public $timestamps = false;
    protected $guard = 'admin';
    protected $guarded = ['id_admin'];

    protected $table = 'admin';
    protected $primaryKey = 'id_admin';

    public function level()
    {
        return $this->belongsTo(Level::class, 'id_level', 'id_level');
    }
}
