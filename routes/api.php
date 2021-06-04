<?php

use App\Enums\CategoryColors;
use App\Enums\CategoryTypes;
use App\Enums\HappeningTypes;
use App\Enums\OfferingTypes;
use App\Enums\UserTypes;
use App\Http\Controllers\AuthController;
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
Route::post('/happenings', [HappeningController::class, 'store']);

Route::get('/create', function (Request $request) {
    $location = new Location();
    $location->meetingPoint = 'Yarak';
    $location->description = 'Yarak';


    $category = new Category();
    $category->name = CategoryTypes::PARTY();
    $category->color = CategoryColors::RED();


    $offering = new Offering();
    $offering->name = OfferingTypes::COCKTAILS();

    $offering2 = new Offering();
    $offering2->name = OfferingTypes::MEALS();


    $happeningtype = new HappeningType();
    $happeningtype->type = HappeningTypes::INDOOR();

    $happening = new Happening();

    $happening->title = 'yayayarak';
    $happening->datetime = '2021-06-06 19:00';
    $happening->price = 22;
    $happening->maxGuests = 22;
    $happening->description = 'asdfasdf';

    $user = User::latest()->first();

    $location->save();
    $category->save();
    $happeningtype->save();

    $happening->location()->associate($location);
    $happening->category()->associate($category);
    $happening->type()->associate($happeningtype);
    $happening->save();

    $offering->save();
    $happening->offerings()->sync($offering);

    $offering2->save();
    $happening->offerings()->sync($offering2);

    $user = User::latest()->first();

    return Happening::with(['location', 'category', 'type', 'users'])->get();
});
