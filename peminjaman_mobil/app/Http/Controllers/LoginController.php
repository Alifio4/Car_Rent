<?php

namespace App\Http\Controllers;

use Rules\Password;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view("login");
    }

    public function register()
    {
        return view("register");
    }

    public function doRegister(Request $request) {
        // kita lakukan validasi request/inputan
        $request->validate([
            'name' => ['required','string', 'max:100'],
            'alamat'=> ['required','string', 'max:100'],
            'no_telepon' => ['required','string', 'max:100'],
            'no_sim' => ['required','string', 'max:100'],
            'email' => ['required','string', 'max:100', 'email', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            
        ]);

        $user = User::create([
            'name' => $request->name,
            'alamat'=> $request->alamat,
            'no_telepon' => $request->no_telepon,
            'no_sim' => $request->no_sim,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);

        return redirect('/login');
    }

    public function doLogin(Request $request) {
        $credentials = $request->validate([
            'email' => ['required','string', 'max:100', 'email'],
            'password' => ['required', Rules\Password::defaults()]
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/mobil');
        }

        return back()->withErrors([
            'email' => 'Email and password invalid.'
        ])->onlyInput('email');
    }

    // public function logout(Request $request) {
    //     Auth::guard('web')->logout();

    //     $request->session()->invalidate();

    //     $request->session()->regenerateToken();

    //     return redirect('/');
    // }
}
