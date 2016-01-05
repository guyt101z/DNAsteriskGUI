<?php

namespace App\Http\Requests;

use App\Http\Requests\Request,Auth;

class UpdateRingGroupRequest extends Request
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
        if($this->input('delete') == 'on'){
            return [];
        }
        return [
            'rg_name' => 'required|alpha_num|unique:ring_groups,rg_name,'.$this->route('id').',id,customer,'.Auth::user()->customer,
            'rg_time' => 'required|numeric',
            'ring_users' => 'required',
            'destination_type' => 'required',
            'forward' => 'required_if:destination_type,forward|numeric',
            'extension' => 'required_if:destination_type,extension',
            'ivr' => 'required_if:destination_type,ivr',
            'ringgroup' => 'required_if:destination_type,ringgroup',
            'schedule' => 'required_if:destination_type,schedule',
            'confbridge' => 'required_if:destination_type,confbridge',
            'voicemail' => 'required_if:destination_type,voicemail',
            'queue' => 'required_if:destination_type,queue'
        ];
    }
}
