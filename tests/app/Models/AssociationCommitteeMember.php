<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociationCommitteeMember extends Model
{
    use HasFactory;

    public $table='assoc_committee_members';
    protected $fillable=['committee',
    'name',
    'image',
    'position',
    'designation',
    ];
}
