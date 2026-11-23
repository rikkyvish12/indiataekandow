<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventImageGallery extends Model
{
    use HasFactory;
   
    public $table='event_image_galleries';
    protected $fillable=['event_name','album_name','image'];
}
