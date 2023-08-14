<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $guarded =['id_level'];

    protected $table = 'level';
    protected $primaryKey = 'id_level';

}
