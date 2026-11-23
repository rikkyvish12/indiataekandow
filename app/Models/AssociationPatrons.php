<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociationPatrons extends Model
{
    use HasFactory;
    public $table='assoc_patrons';
    protected $fillable=[   
        'name',
        'image',
        'position',
        'designation',
    ];
}
