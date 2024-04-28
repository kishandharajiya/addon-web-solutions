<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Login extends APIRequest
{
 
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|max:255|email',
            'password' => 'required|min:6|max:15'
        ];
    }
}
