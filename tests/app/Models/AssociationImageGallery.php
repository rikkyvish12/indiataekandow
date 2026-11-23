<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociationImageGallery extends Model
{
    use HasFactory;
  
    public $table='assoc_image_galleries';
    protected $fillable=[
        'album_name',
        'photo'
    ];
}
