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
}