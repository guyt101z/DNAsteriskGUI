<?php

namespace App\Http\Requests;

use App\Http\Requests\Request,Auth;

class CreateQueueRequest extends Request
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
            'queue_name' => 'required',
            'queue_members' => 'required',
            'queue_strategy' => 'required',
            'queue_timeout' => 'required|numeric',
            'queue_retry' => 'required|numeric'
        ];
    }
}
