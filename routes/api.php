<?php

// use App\Http\Controllers\FeedbackController;

use App\Http\Controllers\API\BookingController;
// use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ColorController;
use App\Http\Controllers\API\ProductController as APIProductController;
use App\Http\Controllers\API\SizeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\ProfileController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\API\FeedbackController; 


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

//Authentication
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::put('/customers/{id}/role', [AuthController::class, 'updateRole']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

//Profile
Route::put('/profile/update', [ProfileController::class, 'update'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'index'])->middleware('auth:sanctum');
Route::get('/owner/show/{id}', [AuthController::class, 'show']);


// Categories API Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/category/list', [CategoryController::class, 'index']);
    Route::post('/category/create', [CategoryController::class, 'store']);
    Route::put('/category/update/{id}', [CategoryController::class, 'update']);
    Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy']);
});
Route::get('/category/show/{id}', [CategoryController::class, 'show']);

// Products API Routes
Route::get('/product/list', [APIProductController::class, 'index']);
Route::post('/product/create', [APIProductController::class, 'store'])->middleware('auth:sanctum');
Route::put('/product/update/{id}', [APIProductController::class, 'update'])->middleware('auth:sanctum');
Route::get('/product/show/{id}', [APIProductController::class, 'show']);
Route::delete('/product/delete/{id}', [APIProductController::class, 'destroy'])->middleware('auth:sanctum');





