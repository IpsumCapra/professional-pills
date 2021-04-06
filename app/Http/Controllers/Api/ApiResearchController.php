<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Research;
use Illuminate\Http\Request;

class ApiResearchController extends Controller
{
    public function index()
    {
        return Research::all()->paginate(config('pagination.api.limit'));
    }

    public function show(Research $entry)
    {
        return $entry;
    }

    public function update(Request $request, Research $entry)
    {
        $fields = $request->validate([
            'successful' => 'required|boolean'
        ]);

        $entry->update([
            'successful' => $fields['successful']
        ]);

        return $entry;
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'patient_id' => 'required|exists:users,id',
            'placebo' => 'required|boolean'
        ]);

        Research::create([
            'patient_id' => $fields['patient_id'],
            'placebo' => $fields['placebo']
        ]);
    }

    public function index_placebo() {
        return Research::all()->where('placebo', '=', 1)->paginate(config('pagination.api.limit'));
    }

    public function index_live() {
        return Research::all()->where('placebo', '=', 0)->paginate(config('pagination.api.limit'));
    }
}
