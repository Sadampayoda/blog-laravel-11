<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationLogin;
use App\Http\Requests\ValidationRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ValidationController extends Controller
{
    public function register()
    {
        return view('validate.register');
    }

    public function login()
    {
        return view('validate.index');
    }

    public function ValidationRegister(ValidationRegister $validationRegister)
    {
        User::create([
            'email' => $validationRegister->email,
            'name' => $validationRegister->name,
            'password' => bcrypt($validationRegister->password)
        ]);

        return redirect()->route('login')->with('success','Akun anda telah dibuat!');
    }

    public function ValidationLogin(ValidationLogin $validationLogin)
    {
        $credintials = $validationLogin->all();

        if(Auth::attempt($credintials)){
            $validationLogin->session()->regenerate();

            return redirect()->route('home')->with('success','Anda berhasil Login.');
        }

        return redirect()->back()->with('error','Email dan Password Salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
