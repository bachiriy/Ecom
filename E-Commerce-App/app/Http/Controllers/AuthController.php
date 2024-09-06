<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index($authPage)
    {
        $validViews = ['login', 'register'];

        if (Auth::check()) {
            return redirect('/');
        } else {
            if (in_array($authPage, $validViews)) {
                return view('auth.' . $authPage);
            } else {
                abort(404);
            }
        }
    }


    public function store(Request $request) // aka register
    {
        $request->validate([
            'name' => 'required|string|min:4|max:100',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8'
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ]);
        return redirect('/login')->with('success', 'Account registered successfully!');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect('/');
        }

        return redirect('/login')->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
