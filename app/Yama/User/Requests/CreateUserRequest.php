<?php

namespace Yama\User\Requests;

use Illuminate\Support\Facades\Request;

class CreateUserRequest extends Request

{
    public function rules()
    {
        return [
            'name'   => 'required|min:3',
            'email'  => 'required|email|exists:users,email',
            'gender' => 'required',
        ];
    }
    
    
    public function messages()
    {
        return [
        
        ];
    }
}
