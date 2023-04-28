<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AboutController;
use App\Http\Controllers\API\SkillController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\LocationFindController;

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
Route::controller(AboutController::class)->group(function(){
    Route::get('edit_about','edit_about');
    Route::post('update_about/{id}','update_about');
});
Route::controller(ServiceController::class)->group(function(){
    Route::get('get_all_service','get_all_service');
    Route::post('create_service','create_service');
    Route::post('/update_service/{id}','update_service');
    Route::post('/delete_service/{id}','delete_service');
});
Route::controller(SkillController::class)->group(function(){
    Route::get('/get_all_skill','get_all_skill');
    Route::post('create_skill','create_skill');
});
// Route::post('/get_location', [App\Http\Controllers\API\LocationFindController::class, 'register']);
Route::controller(LocationFindController::class)->group(function(){
    Route::get('find_location','find_location');
});
