<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;

class ApiDeliveryController extends Controller
{
    // Index all deliveries.
    public function index() {
        return Delivery::all()->paginate(config('pagination.api.limit'));
    }

    // Show a single delivery.
    public function show(Delivery $delivery) {
        return $delivery;
    }

    // Store a new delivery.
    public function store(Request $request) {
        // Validate request
        $fields = $request->validate([
            'destination' => 'required|exists:hospitals,id',
            'contents' => 'required|max:255',
            'quantity' => 'required|between:1,600'
        ]);

        return Delivery::create([
            'destination' => $fields['destination'],
            'contents' => $fields['contents'],
            'quantity' => $fields['quantity']
        ]);
    }
}
