<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventProfile extends Model
{
    use HasFactory;
    
    public $table='event_profiles';
    protected $fillable=['logo','event_name','email','number','facebook','instagram','address','description'];
}
