<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use App\Models\Offering;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'gender' => 'required|string',
            'birthdate' => 'required|date',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'firstname' => $fields['firstname'],
            'lastname' => $fields['lastname'],
            'gender' => $fields['gender'],
            'birthdate' => $fields['birthdate'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $user->interests()->attach($request->input('interests'));

        $token = $user->createToken('happeningtoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Email oder Passwort falsch!'
            ], 401);
        }

        $token = $user->createToken('happeningtoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {

        $request->user()->currentAccessToken()->delete();

        return [
            'message' => 'Logout succesful',
        ];
    }
}
