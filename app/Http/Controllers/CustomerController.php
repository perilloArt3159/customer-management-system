<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerStoreRequest;
use App\Services\CustomerService; 

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $customers = (new CustomerService())->fetchItems(['test' => 'test']); 

        return Inertia::render(
            'Customer/CustomerList', 
            compact('customers')
        );
    }

    /**
     * Store Customer Data 
     * 
     * @param CustomerStoreRequest $request
     * 
     * @return  \Illuminate\Http\RedirectResponse
     */
    public function store(CustomerStoreRequest $request):  \Illuminate\Http\RedirectResponse 
    {
        (new CustomerService())->storeItem(
            $request->only(
                "name",
                "email",
                "contact_number",
                "contact_person",
                "address",
                "tin_number",
                "type",
            )
        );

        return redirect()->back()->with('message', 'New Customer Created');
    }


    /**
     * Store Customer Data 
     * 
     * @param string $slug
     * 
     * @return  \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $slug): \Illuminate\Http\RedirectResponse
    {
        (new CustomerService())->deleteItem($slug); 

        return redirect()->back()->with('message', 'Customer Deleted');
    }
}
