<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntiDoping extends Model
{
    use HasFactory;
  
    public $table='anti_dopings';
    protected $fillable=['description'];
}
