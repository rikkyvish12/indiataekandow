<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patrons extends Model
{
    use HasFactory;
  
    public $table='patrons';
    protected $fillable=['name','image','position','designation'];

}
