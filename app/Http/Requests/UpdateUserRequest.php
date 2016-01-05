<?php

namespace App\Http\Requests;

use App\Http\Requests\Request,Auth;

class UpdateUserRequest extends Request
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
            'email' => 'required_if:enable_email,on|email',
            'vmpassword' => 'required|numeric|min:4',
            'permlevel' => 'required|numeric|min:1',
            'ring_time_1' => 'requiired_if:follow_enabled,1',
            'ring_time_2' => 'required_if:follow_enabled,1',
            'follow_number' => 'required_if:follow_enabled,1|numeric',
            'forward_number' => 'required_if:forward_enabled,1|numeric'
        ];
    }
}
