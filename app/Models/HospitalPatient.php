<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalPatient extends Model
{
    protected $table = 'hospital_patient';

    protected $fillable = [
        'hospital_id',
        'patient_id'
    ];
}
