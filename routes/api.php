<?php
	
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
	Route::post('login', [App\Http\Controllers\API\UserController::class, 'login']);
	Route::post('logout', [App\Http\Controllers\API\UserController::class, 'logout']);
	
//	Route::middleware('auth:api')->get('/user', function (Request $request) {
//		return $request->user();
//	});
	
	Route::group(['middleware' => ['auth:sanctum']], function () {
		Route::apiResources([
			'user' => App\Http\Controllers\API\UserController::class
		]);
	});