<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function registerForm(){
        if(Auth::check()){
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    public function loginForm(){
        if(Auth::check()){
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function register(Request $request){
        $validated = $request->validate([
            'email' => 'required|unique:users|email',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|max:25'
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();
        return redirect()->route('login.show')->with('status', 'Account created. Please login!');
    }

    public function login(Request $request){
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.show');
    }
}
