<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociationNews extends Model
{
    use HasFactory;

    public $table='assoc_news';
    protected $fillable=[
        'coverImage',
        'title',
        'date',
        'link',
    ];
}
