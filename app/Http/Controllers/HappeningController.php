<?php

namespace App\Http\Controllers;

use App\Models\Happening;
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

        if($validator->fails() || $this->validateCategoryInput($request->input('category'))
            || $this->validateLocationInput('location') || $this->validateOfferings($request->input('offerings'))){
            return response()->json(['message' => 'Wrong Input Data'], 422);
        }
        $happening = new Happening();

        $happening->title = $request->input('title');
        $happening->date = $request->input('date');

        $happening->location = $request->input('location');
        $happening->category = $request->input('category');
        $happening->offerings = $request->input('offerings');
        $happening->max_guests = $request->input('max_guests');
        $happening->price = $request->input('price');

        $happening->save();
        $happening->users()->sync([$user->id => ['application_status' => 'owner', 'user_type' => 'host']], false);

        return response()->json(['message'=>'Happening Created','data' => $happening],201);



    }

    public function validateHappening(){
        return Validator::make(request()->all(), [
            'title' => 'required|string|max:25',
            'date' => 'required|date',
            'location' => 'required',
            'category' => 'required',
            'offerings' => 'required',
            'max_guests' => 'required',
            'price' => 'required'
        ]);
    }

    public function validateLocationInput($location) {
        $rules = [];

        if (isset($location['street'])) {
            $rules = [
                'street' => 'string'
            ];
        } else if (isset($location['meetingPoint'])) {
            $rules = [
                'meetingPoint' => 'string',
                'description' => 'string'
            ];
        }

        $validator = Validator::make((array)json_encode($location), $rules);

        if ($validator->passes()) {
            return false;
        }

        return true;
    }

    public function validateCategoryInput($category) {
        $rules = [
            'happeningType' => 'string',
            'categories' => 'array'
        ];

        $validator = Validator::make((array)$category, $rules);

        if ($validator->passes()) {
            return false;
        }

        return true;
    }

    public function validateOfferings($offerings) {
        $rules = [
            'offerings' => 'array',
            'description' => 'string'
        ];

        $validator = Validator::make(array($offerings), $rules);

        if ($validator->passes()) {
            return false;
        }

        return true;
    }
}
