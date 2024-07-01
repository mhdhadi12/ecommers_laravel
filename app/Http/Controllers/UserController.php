<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $credential = $request->only('email', 'password');
        if (Auth::attempt($credential)) {
            $user = Auth::user();

            if ($user->role == "Admin") {
                return redirect()->intended('/admin');
            } else if ($user->role == "Customer") {
                $request->session()->put('user_id', $user->id);
                return redirect()->intended('/');
            }
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
