<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\UserDetailsController;

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
Route::post('login', [UserController::class, 'UserLogin']);
Route::post('/register', [UserController::class, 'UserRegister']);

Route::middleware('auth:api')->group(function () {
    Route::delete('/logout', [UserController::class, 'UserLogout']);
    Route::get('/user_details', [UserDetailsController::class, 'index']);
});
