<?php

namespace App\Http\Controllers;

use App\Enums\CategoryColors;
use App\Enums\CategoryTypes;
use App\Models\Category;
use App\Models\Happening;
use App\Models\HappeningType;
use App\Models\Location;
use App\Models\Offering;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class HappeningController extends Controller
{

    public function store(Request $request) {
        $user = auth()->user();

        $happening = new Happening();
        $happening = Happening::make([
            'title' => $request->input('title'),
            'datetime' => $request->input('date'),
            'price' => $request->input('price'),
            'maxGuests' => $request->input('maxGuests'),
            'description' => $request->input('description')
        ]);

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
        $happening->location()->associate($location);

        $category = Category::create([
            'name' => $request->input('category'),
            'color' => $this->getColor($request->input('category'))
        ]);

        $happening->category()->associate($category);

        $happeningType = HappeningType::create([
            'type' => strtolower($request->input('type'))
        ]);

        $happening->type()->associate($happeningType);

        $happening->save();

        foreach($request->input('offerings') as $offering) {
            $offering = Offering::create([
                'name' => strtolower($offering)
            ]);

            $happening->offerings()->sync($offering);
        }

        $happening->users()->sync([$user->id => ['userType' => 'host']], false);

        return new Response(['message' => 'Happening created!'], 200);
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
}
