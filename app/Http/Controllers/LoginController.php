<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create() {
        if (auth()->user() && !auth()->user()->admin) {
            return redirect('/home');
        }
        else if (auth()->user() && auth()->user()->admin) {
            return redirect('/admin/dashboard');
        } else {
            return view('auth.login');
        }
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        

        if (Auth::attempt($credentials)) {
            if (!auth()->user()->admin) {
                return redirect()->intended('home');
            }
            else if (auth()->user() && auth()->user()->admin) {
                return redirect()->intended('admin/orders');
            } 
            
        } 
        return redirect()->back();

    }
}
