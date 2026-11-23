<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportantPDFEvents extends Model
{
    use HasFactory;
   

    public $table='event_pdf';
    protected $fillable=['event_name','pdf_name','pdf','event_id'];


}
