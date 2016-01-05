<?php

namespace App\Http\Requests;

use App\Http\Requests\Request,Auth;

class UserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        
        return Auth::user()->isAdmin();
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fullname' => 'required',
            'username' => 'required|min:6|alpha_num|unique:users',
            'password' => 'required|min:8|confirmed',
            'email' => 'required_if:enable_email,on|email',
            'vmpassword' => 'required|numeric|min:4',
            'permlevel' => 'required|numeric|min:1'
        ];
    }
}
