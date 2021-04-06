<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Research;
use Illuminate\Http\Request;

class ApiResearchController extends Controller
{
    public function index() {
        return Research::all()->paginate(config('pagination.api.limit'));
    }

    public function show(Research $entry) {
        return $entry;
    }

    public function update(Request $request, Research $entry) {
        $fields = $request->validate([
            'successful' => 'required|boolean'
        ]);

        $entry->update([
            'successful' => $fields['successful']
        ]);
    }
}
