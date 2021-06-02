<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Happening;
use App\Models\HappeningType;
use App\Models\Location;
use App\Models\Offering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class HappeningController extends Controller
{
    public function getAll()
    {
        $happenings = Happening::with('users')->get();
        return response()->json(['message'=>null,'data'=>$happenings],200);
    }

    public function store(Request $request)
    {
        $validator = $this->validateHappening();
        $user = auth()->user();
        $location = new Location();
        $type = new HappeningType();

        // To-Do make constructor
        $happening = new Happening();

        $happening->title = $request->input('title');
        $happening->date = $request->input('date');
        $happening->max_guests = $request->input('max_guests');
        $happening->price = $request->input('price');

        $happening->save();

        if ($request->input('location.meetingPoint')) {
            $location->meetingPoint = $request->input('location.meetingPoint');
            $location->description = $request->input('location.description');
        } else {
            $location->geolocation = $request->input('location.geolocation');
        }

        $location->save();

        $happening->locations()->sync($location, false);

        foreach ($request->input('categories') as $categoryInput) {
            $categories = new Category();
            $categories->type = $categoryInput;
            $categories->save();

            $happening->categories()->sync($categoryInput, false);
        }

        $type = $request->input('type');
        $type->save();

        $happening->types()->sync($type, false);

        foreach ($request->input('offerings') as $offeringInput) {
            $offerings = new Offering();
            $offerings->type = $offeringInput;
            $offerings->save();

            $happening->offerings()->sync($offeringInput, false);
        }

        $happening->users()->sync([$user->id => ['application_status' => 'owner', 'user_type' => 'host']], false);

        return response()->json(['message'=>'Happening Created','data' => $happening],201);
    }

    public function validateHappening() {
        return Validator::make(request()->all(), [
            'title' => 'required|string|max:25',
            'date' => 'required|date',
            'max_guests' => 'required',
            'price' => 'required'
        ]);
    }
}
