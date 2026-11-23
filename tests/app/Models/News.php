<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    public $table='news';
    protected $fillable=[
        'coverImage',
        'title',
        'description',
        'Date',
        'link',
        'type'
    ];
}
