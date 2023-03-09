<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\auth\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('v1')->group(function () {
 Route::post('register', [AuthController::class, 'register']);
 Route::post('login', [AuthController::class, 'login']);
 Route::group(['middleware'=>'auth:api'],function(){
 Route::post('create-help', [AuthController::class, 'createHelp']);
 Route::get('helps', [AuthController::class, 'getHelps']);
});
    });
