<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociationVideoAlbum extends Model
{
    use HasFactory;

    public $table='assoc_video_albums';
    protected $fillable=[
        'album_name',
        'coverImage',
        'timestamp'
    ];
}
