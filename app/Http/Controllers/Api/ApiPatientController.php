<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ApiPatientController extends Controller
{
    public function index() {
        return User::all()->paginate(config('pagination.api.limit'));
    }

    public function show(User $patient) {
        return $patient;
    }
}
