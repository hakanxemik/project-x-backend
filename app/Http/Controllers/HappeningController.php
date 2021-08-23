<?php

namespace App\Http\Controllers;

use App\Enums\CategoryColors;
use App\Enums\CategoryTypes;
use App\Models\Category;
use App\Models\Happening;
use App\Models\HappeningType;
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

        if ($request->input('location.meetingPoint') && $request->input('location.description')) {
            $dataLocation = [
                'meetingPoint' => $request->input('location.meetingPoint'),
                'description' => $request->input('location.description')
            ];
        } else {
            $dataLocation = [
                'geolocation' => $request->input('location.geolocation')
            ];
        }

        $location = Location::create([$dataLocation]);
        $happening->location()->save($location);

        $category = Category::create([
            'name' => $request->input('category'),
            'color' => $this->getColor($request->input('category'))
        ]);

        $happening->category()->save($category);

        $happeningType = HappeningType::create([
            'type' => strtolower($request->input('type'))
        ]);

        $happening->type()->save($happeningType);

        $happening->save();

        $happening->offerings()->attach($request->input('offerings'));

        $happening->users()->sync([$user->id => ['userType' => 'host']], false);

        return new Response('Happening created', 200);
    }

    public function getColor($category) {
        switch($category) {
            case CategoryTypes::PARTY():
                return CategoryColors::RED();
            case CategoryTypes::SPORT();
                return CategoryColors::BLUE();
            case CategoryTypes::GAMES();
                return CategoryColors::YELLOW();
            case CategoryTypes::KULINARIK():
                return CategoryColors::GREEN();
            default:
                return CategoryColors::MAGENTA();
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
