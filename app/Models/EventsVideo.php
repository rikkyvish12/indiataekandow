<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventsVideo extends Model
{
    use HasFactory;

    public $table='events_videos';
    protected $fillable=['youtube_link','event_name','youtube_code','album_name'];
}
