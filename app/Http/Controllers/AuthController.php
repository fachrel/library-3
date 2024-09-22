<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        return view('guest.login');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $userRole = Auth::user()->role;

            if($userRole == "0"){
                return redirect()->route('home')->with('success', 'Login berhasil!');
            }else{
                return redirect()->intended(default: 'dashboard')->with('success', 'Login berhasil!');
            }
        }
        return redirect()->route('login')->with('error', 'Login gagal!');

    }

    public function register(){
        return view('guest.register');
    }

    public function store(UserRequest $request){
        $validated = $request->validated();

        if($request->password_confirmation == $validated['password']){
            $validated['password'] = Hash::make($validated['password']);
            $validated['role'] = '0';

            User::create($validated);
        }else{
            return back()->withErrors(provider: ['password_confirmation' => 'The password does not match.'])->withInput();
        }

        return redirect('/login')->with('success', 'User berhasil dibuat!');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout berhasil!');
    }
}
