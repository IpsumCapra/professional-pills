<?php

use App\Http\Controllers\Api\ApiDeliveryController;
use App\Http\Controllers\Api\ApiHospitalController;
use App\Http\Controllers\Api\ApiPatientController;
use App\Http\Controllers\Api\ApiPatientLocationController;
use App\Http\Controllers\Api\ApiResearchController;

use Illuminate\Support\Facades\Route;

// TODO: API auth separation using x509.

// MD routes
Route::get('patients', [ApiPatientController::class, 'index']);
Route::get('patients/{patient}', [ApiPatientController::class, 'show']);
Route::patch('research/{entry}', [ApiResearchController::class, 'update']);

// Logistic routes
Route::get('patient_locs', [ApiPatientLocationController::class, 'index']);
Route::get('patient_locs/{patient}', [ApiPatientLocationController::class, 'show']);
Route::get('hospitals', [ApiHospitalController::class, 'index']);
Route::get('hospitals/{hospital}', [ApiHospitalController::class, 'show']);
Route::post('patient_locs/{patient}', [ApiPatientLocationController::class, 'store']);
Route::post('deliveries', [ApiDeliveryController::class, 'index']);
Route::post('deliveries/{delivery}', [ApiDeliveryController::class, 'show']);
Route::post('deliveries', [ApiDeliveryController::class, 'store']);

// R&D routes
Route::get('research', [ApiResearchController::class, 'index']);
Route::get('research/{entry}', [ApiResearchController::class, 'show']);
Route::get('research/placebo', [ApiResearchController::class, 'index_placebos']);
Route::get('research/placebo/{entry}', [ApiResearchController::class, 'show_placebos']);
Route::get('research/live', [ApiResearchController::class, 'index_live']);
Route::get('research/live/{entry}', [ApiResearchController::class, 'show_live']);
// Also has access to posting to research.

// IT -- Access to all of the above.
