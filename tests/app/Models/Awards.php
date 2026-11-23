<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Awards extends Model
{
    use HasFactory;
    public $table='awards';
    protected $fillable=['name','title','date','description','coverImage','coverImage1','coverImage2','coverImage3','intro'];

}
