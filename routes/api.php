<?php

use App\Enums\CategoryColors;
use App\Enums\CategoryTypes;
use App\Enums\HappeningTypes;
use App\Enums\OfferingTypes;
use App\Enums\UserTypes;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HappeningController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Happening;
use App\Models\HappeningType;
use App\Models\Location;
use App\Models\Offering;
use App\Models\User;
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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/happenings', [HappeningController::class, 'store'])->middleware('auth:sanctum');

Route::get('/happenings', [HappeningController::class, 'getAll'])->middleware('auth:sanctum');
Route::get('/happenings/host', [HappeningController::class, 'getMyHappenings'])->middleware('auth:sanctum');
Route::get('/happenings/guest', [HappeningController::class, 'getAppliedHappenings'])->middleware('auth:sanctum');
Route::get('/happenings/{id}/join', [HappeningController::class, 'join'])->middleware('auth:sanctum');

Route::put('/user/profile/upload', [UserController::class, 'upload_user_photo'])->middleware('auth:sanctum');
Route::put('/user/edit', [UserController::class, 'updateProfile'])->middleware('auth:sanctum');

Route::get('/user/profile', [UserController::class, 'getUser'])->middleware('auth:sanctum');
Route::get('/categories', [CategoryController::class, 'getAllCategories']); // ->middleware('auth:sanctum');
Route::get('/offerings', [CategoryController::class, 'getAllOfferings']); // ->middleware('auth:sanctum');
Route::get('/types', [CategoryController::class, 'getAllTypes']); // ->middleware('auth:sanctum');
Route::get('/interests', [CategoryController::class, 'getAllInterests']); // ->middleware('auth:sanctum');

