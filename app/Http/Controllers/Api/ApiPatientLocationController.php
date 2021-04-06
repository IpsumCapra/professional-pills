<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\HospitalPatient;
use App\Models\User;
use Illuminate\Http\Request;

class ApiPatientLocationController extends Controller
{
    public function index()
    {
        return HospitalPatient::all()->paginate(config('pagination.api.limit'));
    }

    public function show(User $patient)
    {
        return HospitalPatient::all()->where('patient_id', '=', $patient->id)->paginate(config('pagination.api.limit'));
    }

    public function store(Request $request, User $patient)
    {
        $fields = $request->validate([
            'hospital_id' => 'required|exists:hospitals,id'
        ]);

        Hospital::all()->where('id', '=', $fields['hospital_id'])->first()->users()->attach($patient->id);

        return ['message' => 'Location added successfully.'];
    }
}
