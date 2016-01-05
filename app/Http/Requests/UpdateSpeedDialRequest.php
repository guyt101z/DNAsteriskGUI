<?php

namespace App\Http\Requests;

use App\Http\Requests\Request,App\SpeedDial,Auth,App\UsedExtension;

class UpdateSpeedDialRequest extends Request
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
        
        $SpeedDial = SpeedDial::find($this->route('id'));
        $old = UsedExtension::where('customer',Auth::user()->customer)->where('extension',$SpeedDial->sd_exten)->first();

        return [
            'sd_extension' => 'required|numeric|min:2|unique:used_extensions,extension,'.$old->id.',id,customer,'.Auth::user()->customer,
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
