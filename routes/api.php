<?php

use App\Http\Controllers\API\AboutController;
use App\Http\Controllers\API\LocationFindController;
use App\Http\Controllers\API\PatientController;
use App\Http\Controllers\API\PrescriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(AboutController::class)->group(function () {
    Route::get('edit_about', 'edit_about');
    Route::post('update_about/{id}', 'update_about');
});
Route::controller(PatientController::class)->group(function () {
    Route::get('get_all_patients', 'get_all_patients');
    Route::post('create_patient', 'create_patient');
    Route::post('/update_patient/{id}', 'update_patient');
    Route::post('/delete_patient/{id}', 'delete_patient');
});
Route::controller(PrescriptionController::class)->group(function () {
    Route::get('/get_all_prescriptions', 'get_all_prescriptions');
    Route::post('create_prescription', 'create_prescription');
    Route::post('/delete_prescription/{id}', 'delete_prescription');
});
// Route::post('/get_location', [App\Http\Controllers\API\LocationFindController::class, 'register']);
Route::controller(LocationFindController::class)->group(function () {
    Route::get('find_location', 'find_location');
});
