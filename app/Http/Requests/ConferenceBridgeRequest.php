<?php

namespace App\Http\Requests;

use App\Http\Requests\Request,Auth;

class ConferenceBridgeRequest extends Request
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
            'conf_name' => 'required|unique:conf_bridge,conf_name',
            'conf_extension' => 'unique:used_extensions,extension,NULL,id,customer,'.Auth::user()->customer,
            'conf_auth' => 'min:3|max:6'
        ];
    }
}
