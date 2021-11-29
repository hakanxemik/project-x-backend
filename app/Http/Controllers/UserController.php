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

        list($mime, $data)   = explode(';', $request->file);
        list(, $data)       = explode(',', $data);
        $data = base64_decode($data);

        $mime = explode(':',$mime)[1];
        $ext = explode('/',$mime)[1];
        $name = mt_rand().time();
        $savePath = '/img/user/'.$name.'.'.$ext;

        file_put_contents(public_path().'/'.$savePath, $data);

        $user = Auth::user();
        $user->avatar = $savePath;
        $user->save();

        return new Response('Image uploaded', 200);

    }

    public function getUser() {
        $user =  auth()->user();

        $userData = [
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'interests' => $user->interests,
            'avatar' => $user->avatar,
            'bio' => $user->bio
        ];

        return new Response($userData, 200);
    }

    public function updateBio(Request $request) {
        $user =  auth()->user();
        $user->bio = $request->bio;
        $user->save();
    }
}
