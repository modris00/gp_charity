<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $val =  validator($request->all(), [
            'email' => 'required|email|string',
            'password' => 'required',
            'guard' => 'required|in:admin,beneficiary,donor'
        ]);

        if (!$val->fails()) {
            $guard = $request->guard;
            if (Auth::guard($guard)->attempt($request->only(['email', 'password']))) {
                $role = auth($request->input("guard"))->user()->roles[0];
                $data = auth($request->input("guard"))->user();
                // $data = Auth::user();
                return new Response([
                    'message' => 'logged successfuly',
                    "role" => $role,
                    "user" => $data
                ], Response::HTTP_OK);
            } else {
                return new Response([
                    'message' => 'error credentials , try again',
                ], Response::HTTP_BAD_REQUEST);
            }
        } else {
            return new Response([
                'message' => $val->getMessageBag()->first(),
            ], Response::HTTP_BAD_REQUEST);
        }
    }


    public function logout(Request $request)
    {
        if (auth('admin')->check()) {
            $guard = 'admin';
        } elseif (auth('donor')->check()) {
            $guard = 'donor';
        } else {
            $guard = 'beneficiary';
        }

        Auth::guard($guard)->logout();
        $request->session()->invalidate();

        return response()->json(['message' => "logout  successfully", 'guard' => $guard], Response::HTTP_OK);
    }
}
