<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

   
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.register', ['user' => new User]);
    }
     /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            "name" => 'required',
            "email" => ['required', 'email'],
            "password" => ['required', 'min:6']            
        ]);
        
        User::create($credentials);
        auth()->attempt($credentials);
        return redirect()->route("home")->with('success', "Successfully registered");
    }

    /**
     * Show the form for login.
     */
    public function login()
    {
        return view('user.login', ['user' => new User]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        if (auth()->attempt($credentials) ) {
            return redirect()->route("home")->with('success', "Logged in Successfully");
        }
        return redirect()->back()->withErrors(
            [
                'email' => 'Invalid credentials',
                'password' => 'Invalid credentials'
            ]
        );
 //       return redirect()->route("user.login")->with('error', "Invalid Credentials");
    }

    public function logout(Request $request) {
        auth()->logout();
        return redirect()->route("home")->with('success', "Successfully logged out");
    }
}
