<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientAuthController extends Controller
{
    public function showLogin()
    {
        return view('patient.login');
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('patient')->attempt($credentials)) {

            $request->session()->regenerate();

            return redirect('/patient/interface');
        }

        return back()->with('error', 'Email ou mot de passe incorrect');
    }

    public function logout(Request $request)
    {
        Auth::guard('patient')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('patient/login');
    }
}
