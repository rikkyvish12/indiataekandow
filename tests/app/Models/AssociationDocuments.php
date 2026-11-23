<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssociationDocuments extends Model
{
    use HasFactory;
    public $table='assoc_documents';
    protected $fillable=['type',
    'name',
    'file',
    ];
}
