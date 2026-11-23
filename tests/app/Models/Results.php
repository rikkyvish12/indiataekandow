<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    use HasFactory;

    public $table='results';
    protected $fillable=['date','event_name','group','time','round','result_pdf','event'];
}
