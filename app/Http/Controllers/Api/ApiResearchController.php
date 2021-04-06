<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Research;
use Illuminate\Http\Request;

class ApiResearchController extends Controller
{
    public function index() {
        return Research::all();
    }

    public function show(Research $entry) {
        return $entry;
    }
}
