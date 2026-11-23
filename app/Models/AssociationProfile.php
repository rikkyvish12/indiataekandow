<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociationProfile extends Model
{
    use HasFactory;
  
    public $table='assoc_profiles';
        protected $fillable=[
            'logo',
            'email',
            'number',
            'facebook',
            'instagram',
            'address',
            'description'
        ];

}
