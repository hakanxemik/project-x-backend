<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\User;
use  Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function upload_user_photo(Request $request) {

        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048'
        ]);


        // Handle the user upload of avatar
        if($request->hasFile('file')){
            $image = $request->file('file');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('img/user/' . $filename);
            Image::make($image->getRealPath())->save($path);

            $user = Auth::user();
            $user->avatar = $path;
            $user->save();
        }

        return new Response('Image uploaded amg', 200);

    }

    public function getUser() {
        $user =  auth()->user();

        $type = pathinfo($user->avatar, PATHINFO_EXTENSION);
        $data = file_get_contents($user->avatar);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $userData = [
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'interests' => $user->interests,
            'avatar' => $base64
        ];

        return new Response($userData, 200);
    }
}
