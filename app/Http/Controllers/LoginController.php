<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ( $request->isMethod('post') ) {
            $validated = $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);
            $credential = $request->only('email', 'password');
            if (Auth::attempt($credential)) {
                $user = User::where('email', $request->input('email'))->first();
                if ( $user->activo == 0 )
                    return redirect('/login')->with('msgType', 'danger')->with('msg', 'Usuario desactivado');
				$request->session()->regenerate();
				return redirect("/dashboard");
			} else {
                return redirect('/login')->with('msgType', 'danger')->with('msg', 'Usuario no valido');
			}
        }
        return view('login/login');
    }

    public function logout(Request $request)
	{
		Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
		return redirect("/");
	}
}
