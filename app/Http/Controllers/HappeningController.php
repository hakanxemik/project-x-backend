<?php

namespace App\Http\Controllers;

use App\Enums\CategoryColors;
use App\Enums\CategoryTypes;
use App\Models\Category;
use App\Models\Happening;
use App\Models\Type;
use App\Models\Location;
use App\Models\Offering;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class HappeningController extends Controller
{

    public function store(Request $request) {
        $user =  auth()->user();

        if (!$user) {
            return new Response('User not found!', 400);
        }

        // TODO-DO Happening ohne Title funktioniert! Error
        // TODO-DO Transaction and Commits -> Eloquent


        $happening = Happening::make([
            'title' => $request->input('title'),
            'datetime' => $request->input('date'),
            'price' => $request->input('price'),
            'maxGuests' => $request->input('maxGuests'),
            'description' => $request->input('description'),
            'offeringsDescription' => $request->input('offeringsDescription')
        ]);

        // TODO Mit Throw Exception testen ob commit funktioniert

        $dataLocation = [
            'meetingPoint' => $request->input('location.meetingPoint'),
            'description' => $request->input('location.description')
        ];

        $location = Location::create($dataLocation);

        $happening->location()->associate($location);

        $happening->save();

        $happeningType = $request->input('type');

        $happening->type()->attach($happeningType);

        $happening->category()->attach($request->input('category'));

        $happening->offerings()->attach($request->input('offerings'));

        $happening->users()->sync([$user->id => ['userType' => 'host']], false);

        return new Response('Happening created', 200);
    }

    // TO-DO DEAD CODE
    public function getColor($category) {
        switch($category) {
            case 'party':
                return 'red';
            case 'grill';
                return 'blue';
            default:
                return 'purple';
        }
    }

    public function getAll(Request $request) {
        $happenings = Happening::with('location', 'category', 'users', 'type', 'offerings')
                ->get();

        // TODO Daten die ich nicht brauch raushauen
        // TODO Pagination -> im FE brauche ich nur Teile vom Happening
        return new Response($happenings, 200);
    }

    public function getMyHappenings(Request $request) {
        $happenings = Happening::with('location', 'category', 'users', 'type', 'offerings')
            ->whereHas('users', function($q) {
                $q->where('user_id', '=', auth()->user()->id)->where('userType', '=', 'host');

            })
            ->get();

            // TODO - Funktion auslagern
        // TODO Daten die ich nicht brauch raushauen
        // TODO Pagination -> im FE brauche ich nur Teile vom Happening
        return new Response($happenings, 200);
    }

    public function getAppliedHappenings(Request $request) {
        $happenings = Happening::with('location', 'category', 'users', 'type', 'offerings')
            ->whereHas('users', function($q) {
                $q->where('user_id', '=', auth()->user()->id)->where('userType', '=', 'guest');
            })
            ->get();

        // TODO Daten die ich nicht brauch raushauen
        // TODO Pagination -> im FE brauche ich nur Teile vom Happening
        return new Response($happenings, 200);
    }

    public function join($id) {
        $user =  auth()->user();
        $happening = Happening::findOrFail($id);

        $happening->users()->sync([$user->id => ['userType' => 'guest']], false);

        return new Response('Joined!', 200);
    }
}
