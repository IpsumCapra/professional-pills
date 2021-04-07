<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Http\Request;

class ApiHospitalController extends Controller
{
    // Show all hospitals.
    public function index() {
        return Hospital::all();
    }

    // Show specific hospital.
    public function show(Hospital $hospital) {
        return $hospital;
    }
}
