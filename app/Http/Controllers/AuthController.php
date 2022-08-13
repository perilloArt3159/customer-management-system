<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;

use Illuminate\Http\Request;
use Inertia\Inertia;

use Symfony\Component\HttpFoundation\Response; 

class AuthController extends Controller
{
    /**
     * Class Constructor    
     * 
     * @return null
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Render Login Page 
     * 
     * @return \Inertia\Response
     */
    public function login(): \Inertia\Response
    {
        return Inertia::render('Auth/AuthLogin');
    }

    /**
     * Handle Login  
     * 
     * @param LoginRequest $request 
     * 
     * @return void
     */
    public function authenticate (LoginRequest $request) : Response
    {
        $isAuthenticated = (new AuthService())->authenticate($request->only('name', 'password')); 
        
        if ($isAuthenticated)
        {
            $request->session()->regenerate();
            
            return redirect()->intended()->with('message', 'Login Successfull'); 
        }
        
        return redirect()->back()->with('error', 'Invalid Credentials');
    }

    /**
     * Logout User
     * 
     * @param Request $request
     * 
     * @return null 
     */
    public function logout(Request $request) : Response
    {
        (new AuthService())->unauthenticate($request);

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended('login')->with('message', 'Logout Successfull!');
    }
}