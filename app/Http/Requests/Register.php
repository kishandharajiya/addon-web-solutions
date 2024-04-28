<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Register extends APIRequest
{
 
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|max:15',
            'c_password'=> 'required|same:password'
        ];
    }
}
