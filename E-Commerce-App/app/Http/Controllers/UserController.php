<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display users profile.
     */

    public function show()
    {
        if (Auth::check()) {
            return view('users.profile');
        } else {
            return abort(404);
        }
    }

    /**
     * Update users profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|min:4|max:100',
            'email' => 'required|email|unique:users|max:255',
        ]);

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ]);

        return redirect('/profile')->with('success', 'Profile updated successfully');
    }


    /**
     * Remove users account.
     */
    public function destroy()
    {
        User::destroy(Auth::id());
        Auth::logout();
        return redirect('/');
    }
}
