<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociationPresidentMessage extends Model
{
    use HasFactory;
   
    public $table='assoc_president_messages';
    protected $fillable=[
     'description'];
}
