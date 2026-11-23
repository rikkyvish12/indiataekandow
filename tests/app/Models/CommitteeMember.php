<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteeMember extends Model
{
    use HasFactory;

    public $table='committee_members';
    protected $fillable=['committee_id','name','image','position','designation'];

}
