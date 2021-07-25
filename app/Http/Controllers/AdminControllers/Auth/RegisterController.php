<?php

namespace App\Http\Controllers\AdminControllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public  $user;

    public function __construct()
    {
        $this->middleware('guest');
        $this->user = new User;//user e model
    }

    //
    public function index()
    {
        return view('auth.registerpage');
    }

    public function store(Request $request)
    {
        //dd();

        //validation
        $request->validate([
            'id' => ['required','max:20'],
            'name' => ['required','max:20'],
            'password' => ['required','confirmed'],
            'email' => ['required','email','max:255'],
        ]);

        $this->user->create([
            'id' => $request->id,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'email' => $request->email,
        ]);

        Auth::attempt($request->only('email','password'));
        //metode untuk login

        return redirect()->route('dashboard');
    }
}
