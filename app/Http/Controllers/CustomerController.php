<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerListRequest;
use App\Http\Requests\CustomerStoreRequest;
use App\Models\Customer;
use App\Services\CustomerService; 

use Inertia\Inertia;

use PDF; 

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
     * @param Request $request
     * 
     * @return \Inertia\Response
     */
    public function index(CustomerListRequest $request): \Inertia\Response
    {
        $customers = (new CustomerService())->fetchItems(
            $request->only(
                'search',     
                'sizePerPage',
                'showPage',
                'sortBy',     
                'sortDesc'   
            )
        ); 

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

    /**
     * Generate PDF 
     * 
     * @return stream?
     */
    public function pdf()
    {
        $data = 
        [
            'title' => 'CUSTOMERS LIST',
            'items' => Customer::all()
        ]; 

        $pdf = PDF::loadView('pdf.customer', $data)
            ->setPaper('a4', 'landscape');

        return $pdf->stream('customers_list.pdf');
    }
}
