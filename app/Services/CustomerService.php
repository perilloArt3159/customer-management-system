<?php 

namespace App\Services;

use App\Models\Customer;
use App\Services\BaseService; 

class CustomerService extends BaseService
{
    /**
     * Fetch Items 
     * 
     * @param array $data 
     * 
     * @return CustomerCollection
     */
    public function fetchItems($data)
    {
        return Customer::all();
    }

    /**
     * Store Item 
     * 
     * @param array $data 
     * 
     * @return null
     */
    public function storeItem($data)
    {
        Customer::create(
            [
                "name"              => $data['name'],
                "email"             => $data['email'],
                "contact_number"    => $data['contact_number'],
                "contact_person"    => $data['contact_person'],
                "address"           => $data['address'],
                "tin_number"        => $data['tin_number'],
                "type"              => $data['type'],
            ]
        );
    }
}