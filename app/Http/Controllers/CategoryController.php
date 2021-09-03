<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Type;
use App\Models\Interest;
use App\Models\Offering;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getAllCategories(Request $request) {
        return new Response(json_encode(Category::all()), 200);
    }

    public function getAllTypes(Request $request) {
        return new Response(Type::all(), 200);
    }

    public function getAllOfferings(Request $request)
    {
        return new Response(Offering::all(), 200);
    }

    public function getAllInterests(Request $request) {
        return new Response(Interest::all(), 200);
    }
}
