<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoAlbum extends Model
{
    use HasFactory;
 

    public $table='video_albums';
    protected $fillable=['event_name','album_name','coverImage','timestamp'];

}
