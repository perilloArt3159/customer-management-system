<?php 

namespace App\Services; 

use App\Services\BaseService; 
use Illuminate\Support\Facades\Auth;

class AuthService extends BaseService
{

    /**
     * Authenticate User 
     * 
     * @param array $data 
     * 
     * @return bool
     */
    public function authenticate($data) : bool 
    {
        $credentials = $data; 

        return Auth::attempt($credentials); 
    }

    /**
     * Logout User
     * 
     * @return null 
     */
    public function unauthenticate()
    {
        Auth::guard('web')->logout();
    }
}