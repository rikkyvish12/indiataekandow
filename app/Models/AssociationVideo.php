<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociationVideo extends Model
{
    use HasFactory;

    public $table='assoc_videos';
    protected $fillable=['youtube_link','youtube_code','album_name'];
}
