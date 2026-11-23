<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    use HasFactory;

    public $table='associations';
    protected $fillable=['type','logo','name','presidentName','presidentDescription','presidentEmail','secretaryName','secretaryDescription','secretaryEmail','description'];
}
