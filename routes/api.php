<?php

use App\Http\Controllers\Api\ApiDeliveryController;
use App\Http\Controllers\Api\ApiHospitalController;
use App\Http\Controllers\Api\ApiPatientController;
use App\Http\Controllers\Api\ApiPatientLocationController;
use App\Http\Controllers\Api\ApiResearchController;

use Illuminate\Support\Facades\Route;

// MD routes
Route::middleware('auth.api:md')->get('patients', [ApiPatientController::class, 'index'])->middleware('auth.api:md');
Route::middleware('auth.api:md')->get('patients/{patient}', [ApiPatientController::class, 'show']);
Route::middleware('auth.api:md')->patch('research/{entry}', [ApiResearchController::class, 'update']);

// Logistic routes
Route::middleware('auth.api:logistics')->get('patientlocations', [ApiPatientLocationController::class, 'index']);
Route::middleware('auth.api:logistics')->get('patientlocations/{patient}', [ApiPatientLocationController::class, 'show']);
Route::middleware('auth.api:logistics')->get('hospitals', [ApiHospitalController::class, 'index']);
Route::middleware('auth.api:logistics')->get('hospitals/{hospital}', [ApiHospitalController::class, 'show']);
Route::middleware('auth.api:logistics')->post('patientlocations/{patient}', [ApiPatientLocationController::class, 'store']);
Route::middleware('auth.api:logistics')->get('deliveries', [ApiDeliveryController::class, 'index']);
Route::middleware('auth.api:logistics')->get('deliveries/{delivery}', [ApiDeliveryController::class, 'show']);
Route::middleware('auth.api:logistics')->post('deliveries', [ApiDeliveryController::class, 'store']);
Route::middleware('auth.api:logistics')->delete('deliveries/{delivery}', [ApiDeliveryController::class, 'delete']);

// R&D routes
Route::middleware('auth.api:rnd')->get('research', [ApiResearchController::class, 'index']);
Route::middleware('auth.api:rnd')->get('research/placebo', [ApiResearchController::class, 'index_placebo']);
Route::middleware('auth.api:rnd')->get('research/live', [ApiResearchController::class, 'index_live']);
Route::middleware('auth.api:rnd')->get('research/{entry}', [ApiResearchController::class, 'show']);
Route::middleware('auth.api:rnd')->post('research', [ApiResearchController::class, 'store']);

// IT -- Access to all of the above.
