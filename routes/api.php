<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::get('/student', function () {
//     return "hello from api";
// });
// Route::get('/stud', [StudentController::class, 'index']);


// * open routes
Route::post("register", [ApiController::class, "register"]);
Route::post("login", [ApiController::class, "login"]);

// * protected routes
Route::middleware('auth', function () {
    Route::get("profile", [ApiController::class, "profile"]);
    Route::get("logout", [ApiController::class, "logout"]);
});
