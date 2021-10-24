<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Research;
use Illuminate\Http\Request;

class ApiResearchController extends Controller
{
    // List all research.
    public function index()
    {
        return Research::all()->paginate(config('pagination.api.limit'));
    }

    // Show a single research entry.
    public function show(Research $entry)
    {
        return $entry;
    }

    // Update a research result.
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

    // Create a new research.
    public function store(Request $request)
    {
        $fields = $request->validate([
            'patient_id' => 'required|exists:users,id',
            'placebo' => 'required|boolean'
        ]);

        return Research::create([
            'patient_id' => $fields['patient_id'],
            'placebo' => $fields['placebo']
        ]);
    }

    // Index all placebo research.
    public function index_placebo() {
        return Research::all()->where('placebo', '=', 1)->paginate(config('pagination.api.limit'));
    }

    // Index all live research.
    public function index_live() {
        return Research::all()->where('placebo', '=', 0)->paginate(config('pagination.api.limit'));
    }
}
