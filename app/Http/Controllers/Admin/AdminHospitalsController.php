<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Api\Controller;
use App\Models\Hospital;
use App\Models\User;
use Illuminate\Http\Request;

class AdminHospitalsController extends Controller
{
    // Admin hospitals index route
    public function index()
    {
        // When a query is given search by query
        $query = request('q');
        if ($query != null) {
            $hospitals = Hospital::search($query)->get();
        } else {
            $hospitals = Hospital::all();
        }
        $hospitals = $hospitals->sortBy(function($hospital) {return $hospital->name;}, SORT_NATURAL | SORT_FLAG_CASE)
            ->paginate(config('pagination.web.limit'))->withQueryString();

        // Return admin hospitals index view
        return view('admin.hospitals.index', ['hospitals' => $hospitals]);
    }

    // Admin hospitals store route
    public function store(Request $request)
    {
        // Validate input
        $fields = $request->validate([
            'name' => 'required|min:2|max:60',
            'province' => 'required|min:2|max:255',
        ]);

        // Create hospital
        $hospital = Hospital::create([
            'name' => $fields['name'],
            'province' => $fields['province']
        ]);

        // Go to the new admin hospital page
        return redirect()->route('admin.hospitals.show', $hospital);
    }

    // Admin hospitals show route
    public function show(Hospital $hospital)
    {
        // Return admin hospitals show view
        return view('admin.hospitals.show', [
            'hospital' => $hospital
        ]);
    }

    // Admin hospitals edit route
    public function edit(Hospital $hospital)
    {
        return view('admin.hospitals.edit', ['hospital' => $hospital]);
    }

    // Admin hospitals update route
    public function update(Request $request, Hospital $hospital)
    {
        // Validate input
        $fields = $request->validate([
            'name' => 'required|min:2|max:60',
            'province' => 'required|min:2|max:255',
        ]);

        // Update hospital
        $hospital->update([
            'name' => $fields['name'],
            'province' => $fields['province']
        ]);

        // Go to the admin hospital page
        return redirect()->route('admin.hospitals.show', $hospital);
    }

    // Admin hospitals delete route
    public function delete(Hospital $hospital)
    {
        // Delete hospital
        $hospital->delete();

        // Go to the hospitals index page
        return redirect()->route('admin.hospitals.index');
    }
}
