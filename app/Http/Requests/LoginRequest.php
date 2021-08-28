<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'password' => 'required'
        ];
    }
    public function getCredentials()
    {
        $username = $this->get('name');

        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            return [
                'email' => $username,
                'password' => $this->get('password')
            ];
        }

        return $this->only('name', 'password');
    }
}
