<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taekwondo extends Model
{
    use HasFactory;

    public $table='taekwondo';
    protected $fillable=['description',
    'taekwondo',
    't_f_i',
    'Swimming',
    'Fencing',
    'Riding',
    'LaserRun'
];
}
