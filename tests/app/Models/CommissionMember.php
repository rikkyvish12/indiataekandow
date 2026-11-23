<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionMember extends Model
{
    use HasFactory;

    public $table='commission_members';
    protected $fillable=['commission_id','name','image','position','designation'];

}
