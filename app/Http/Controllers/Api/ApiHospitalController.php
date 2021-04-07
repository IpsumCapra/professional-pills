<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Http\Request;

class ApiHospitalController extends Controller
{
    public function index() {
        return Hospital::all()->pagination(config('pagination.api.limit'));
    }

    public function show(Hospital $hospital) {
        return $hospital;
    }
}
