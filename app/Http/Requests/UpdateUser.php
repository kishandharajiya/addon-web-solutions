<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends APIRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "id" => 'required|exists:users,id',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.request()->id,
        ];
    }
}
