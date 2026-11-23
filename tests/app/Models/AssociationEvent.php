<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociationEvent extends Model
{
    use HasFactory;
    
    public $table='assoc_events';
    protected $fillable=[
        'eventType',
        'title',
        'coverImage',
        'location',
        'date',
        'intro',
        'link'
    ];
}
