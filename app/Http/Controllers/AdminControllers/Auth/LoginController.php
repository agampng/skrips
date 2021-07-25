<?php

namespace App\Http\Controllers\AdminControllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view("auth.loginpage");
    }

    public function store(Request $request)
    {
        $request->validate([
            'password' => ['required'],
            'email' => ['required','email'],
        ]);

        if( !Auth::attempt($request->only('email','password')) )
        {
            return back()->with('status','failed login');
        }
        //metode untuk login

        return redirect()->route('dashboard');

    }
}
