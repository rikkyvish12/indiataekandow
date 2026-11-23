<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociationAlbum extends Model
{
    use HasFactory;

    public $table='assoc_albums';
    protected $fillable=[
    'album_name',
    'coverImage',
    'timestamp'];
}
