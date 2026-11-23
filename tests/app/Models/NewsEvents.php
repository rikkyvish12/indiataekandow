<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsEvents extends Model
{
    use HasFactory;
  
    public $table='event_news';
    protected $fillable=['coverImage','title','date','link','event_name','event_id'];
}
