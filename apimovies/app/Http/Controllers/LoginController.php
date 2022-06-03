<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validateLogin($request);

        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([                
                'token' => $request->user()->createToken($request->email)->plainTextToken,
                'message' => 'Success',
                'user' => Auth::user()
                
            ], 200);
        }else{

            return response()->json([
                'message' => 'No Autorizado'
            ], 401);
        }
    }

    public function validateLogin(Request $request)
    {
        
        return $request->validate([
            'email'=> 'required|email',
            'password' => 'required'
        ]);
    }
}
