<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociationGovernance extends Model
{
    use HasFactory;
    
    public $table='assoc_governances';
    protected $fillable=[   
        'name',
        'image',
        'position',
        'designation',
    ];

}
