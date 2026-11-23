<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RulesAndRegulations extends Model
{
    use HasFactory;
  
    public $table='rules_and_regulations';
    protected $fillable=['name','description','pdf'];
}
