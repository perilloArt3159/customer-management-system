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
        $items  =   Customer::query()
                        ->when(
                            isset($data['sortByColumn']),
                            function ($query) use ($data)
                            {
                                $sortDirection = 'asc';

                                if ($data['sortByDescending'])
                                {
                                    $sortDirection = 'desc';
                                }

                                $query->orderBy($data['sortByColumn'], $sortDirection);
                            }
                        )
                        ->where(
                            function ($query) use ($data)
                            {
                                if (isset($data['search']))
                                {
                                    $search = "%{$data['search']}%";

                                    $query->where('name', 'like', $search);
                                }
                            }
                        )
                        ->paginate(
                            $perPage = $data['sizePerPage'] ?? 10,
                            $columns = ['*'],
                            $pageName = "page",
                            $page = $data['showPage'] ?? 1
                        );
        
                        return $items;
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

    /**
     * Delete Item 
     * 
     * @param string $slug 
     * 
     * @return null
     */
    public function deleteItem(string $slug)
    {
        Customer::findBySlugOrFail($slug)
            ->delete(); 
    }
}