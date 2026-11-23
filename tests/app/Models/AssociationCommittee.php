<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociationCommittee extends Model
{
    use HasFactory;

    public $table='assoc_committees';
    protected $fillable=['name'];

}
