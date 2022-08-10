<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
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
    public function index(): \Inertia\Response
    {
        return Inertia::render('Home/DashboardAdmin');
    }
}
