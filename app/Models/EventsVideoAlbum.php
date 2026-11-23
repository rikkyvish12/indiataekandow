<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsVideoAlbum extends Model
{
    use HasFactory;
    
    public $table='events_video_albums';
    protected $fillable=['event_name','album_name','cover_image','timestamp'];
}
