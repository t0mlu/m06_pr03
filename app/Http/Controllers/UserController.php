<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('signup')->only('signup');
        $this->middleware('signin')->only('signin');
    }

    public function signup(Request $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'password' => bcrypt($request['password']),
            'email' => $request['email']
        ]);

        return response()->noContent();
    }


    public function signin(Request $request)
    {
        if (Auth::attempt($request->all())) {
            $token = $request->user()->createToken('API Bearer Token');
            return response()->json(['token' => $token->plainTextToken], 200);
        } else {
            return response()->json(['error' => 'The provided credentials do not match our records.'], 422);
        }
    }
}
