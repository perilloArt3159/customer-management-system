<?php

namespace App\Http\Controllers;

use App\Services\CustomerService; 

use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Class Constructor    
     * 
     * @return null
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Render Login Page 
     * 
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        return Inertia::render('Customer/CustomerList');
    }
}
