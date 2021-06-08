<?php

namespace App\Http\Controllers;

use App\Enums\CategoryTypes;
use App\Enums\HappeningTypes;
use App\Enums\OfferingTypes;
use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAllCategories(Request $request) {
        return new Response(json_encode(CategoryTypes::getValues()), 200);
    }

    public function getAllTypes(Request $request) {
        return new Response(HappeningTypes::getValues(), 200);
    }

    public function getAllOfferings(Request $request) {
        return new Response(OfferingTypes::getValues(), 200);
    }
}
