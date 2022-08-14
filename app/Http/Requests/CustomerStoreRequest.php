<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CustomerStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name"              => ['required', 'string', 'min:1', 'max:255'],           
            "email"             => ['nullable', 'email', 'unique:customers,email'], 
            "contact_number"    => ['nullable', 'numeric', 'digits:11'],
            "contact_person"    => ['nullable', 'string'], 
            "address"           => ['required', 'string'],
            "tin_number"        => ['nullable', 'numeric', 'digits:12'],
            "type"              => ['nullable', 'string']
        ];
    }
}
