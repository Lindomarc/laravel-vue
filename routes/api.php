<?php


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
//	Route::post('login', [App\Http\Controllers\API\UserController::class, 'login']);
//	Route::post('logout', [App\Http\Controllers\API\UserController::class, 'logout']);
//
//	Route::middleware('auth:api')->get('/user', function (Request $request) {
//		return $request->user();
//	});
// routes/api.php
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/vehicle/form', [App\Http\Controllers\API\VehicleController::class, 'form'])
        ->name('vehicle.form');

    Route::apiResources([
        'user' => App\Http\Controllers\API\UserController::class,
        'mdfe' => App\Http\Controllers\API\MdfeController::class,
        'vehicle' => App\Http\Controllers\API\VehicleController::class
    ]);
    Route::post('/me', [App\Http\Controllers\API\AuthController::class, 'me'])->name('api.auth.me');

});


Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register'])->name('api.auth.register');
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login'])->name('api.auth.login');

