<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $fillable=['patient_id','prescription','note'];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }
}
