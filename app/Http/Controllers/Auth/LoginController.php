<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        //validation
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //log in
        if(!Auth::attempt($request->only('email', 'password'), $request->remember)){
            return back()->with('status', 'Invalid login credentials.');
        }

        //redirect
        return redirect()->route('dashboard');
    }
}
