<?php

use App\Http\Controllers\Api\ApiDeliveryController;
use App\Http\Controllers\Api\ApiHospitalController;
use App\Http\Controllers\Api\ApiPatientController;
use App\Http\Controllers\Api\ApiPatientLocationController;
use App\Http\Controllers\Api\ApiResearchController;

use Illuminate\Support\Facades\Route;

// TODO: API auth separation using x509.

Route::middleware('auth.x509')->group(function () {
    // MD routes
    Route::get('patients', [ApiPatientController::class, 'index']);
    Route::get('patients/{patient}', [ApiPatientController::class, 'show']);
    Route::patch('research/{entry}', [ApiResearchController::class, 'update']);

    // Logistic routes
    Route::get('patientlocations', [ApiPatientLocationController::class, 'index']);
    Route::get('patientlocations/{patient}', [ApiPatientLocationController::class, 'show']);
    Route::get('hospitals', [ApiHospitalController::class, 'index']);
    Route::get('hospitals/{hospital}', [ApiHospitalController::class, 'show']);
    Route::post('patientlocations/{patient}', [ApiPatientLocationController::class, 'store']);
    Route::get('deliveries', [ApiDeliveryController::class, 'index']);
    Route::get('deliveries/{delivery}', [ApiDeliveryController::class, 'show']);
    Route::post('deliveries', [ApiDeliveryController::class, 'store']);
    Route::delete('deliveries/{delivery}', [ApiDeliveryController::class, 'delete']);

    // R&D routes
    Route::get('research', [ApiResearchController::class, 'index']);
    Route::get('research/placebo', [ApiResearchController::class, 'index_placebo']);
    Route::get('research/live', [ApiResearchController::class, 'index_live']);
    Route::get('research/{entry}', [ApiResearchController::class, 'show']);
    Route::post('research', [ApiResearchController::class, 'store']);

    // IT -- Access to all of the above.
});
