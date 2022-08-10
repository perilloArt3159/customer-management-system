<?php

namespace App\Http\Controllers;

use App\Services\AuthService;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthController extends Controller
{
    /**
     * Class Constructor    
     * 
     * @return null
     */
    public function __construct()
    {
        $this->middleware('guest');
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
}