<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresidentMessage extends Model
{
    use HasFactory;
  
    public $table='president_messages';
    protected $fillable=['description'];
}
