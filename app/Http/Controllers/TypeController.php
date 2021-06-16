<?php

namespace App\Http\Controllers;

use App\Enums\HappeningTypes;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TypeController extends Controller
{
    public function getAllTypes(Request $request) {
        return new Response(HappeningTypes::getValues(), 200);
    }
}
