<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\ImageCropController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth',
], function (){
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
});

Route::group([
    'prefix' => 'users',
    'middleware' => ['auth:sanctum']
], function (){
    Route::get('/', [UserController::class, 'index']);
});

Route::group([
    'prefix' => 'images',
    'middleware' => ['auth:sanctum']
], function (){
    Route::post('crop-image', ImageCropController::class);
});


