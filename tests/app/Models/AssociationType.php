<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociationType extends Model
{
    use HasFactory;

    public $table='association_type';
   // protected $fillable=['type','logo','name','presidentName','presidentDescription','presidentEmail','secretaryName','secretaryDescription','secretaryEmail','description'];
}
