<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoGallery extends Model
{
    use HasFactory;

    public $table='videos';
    protected $fillable=['youtube_link','youtube_code','album_name'];
}
