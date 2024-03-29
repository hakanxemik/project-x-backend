<?php

use App\Enums\CategoryColors;
use App\Enums\CategoryTypes;
use App\Enums\HappeningTypes;
use App\Enums\OfferingTypes;
use App\Enums\UserTypes;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HappeningController;
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
Route::post('/login', [AuthController::class, 'login']);
Route::post('/happenings', [HappeningController::class, 'store']); //->middleware('auth:sanctum');
Route::get('/categories', [CategoryController::class, 'getAllCategories']); // ->middleware('auth:sanctum');
Route::get('/offerings', [CategoryController::class, 'getAllOfferings']); // ->middleware('auth:sanctum');
Route::get('/types', [CategoryController::class, 'getAllTypes']); // ->middleware('auth:sanctum');

