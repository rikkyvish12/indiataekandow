<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainProfile extends Model
{
    use HasFactory;
    
    public $table='main_profiles';
    protected $fillable=['mirache','address','map','title','description','smallDescription','logo','number','email'];
}
