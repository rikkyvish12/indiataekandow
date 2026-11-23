<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TFITent extends Model
{
    use HasFactory;

    public $table='t_f_i_tents';
    protected $fillable=['title','description'];
}
