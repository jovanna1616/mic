<?php

namespace App\Http\Requests;

use Request;
use App\Shift;

class JobCreateRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:2|max:255',
            'role' => 'required',
            'practice' => 'required|integer',
            'description' => 'required|max:1000',
            'startTime' => 'required',
            'endTime' => 'required',
            'price' => 'required|integer',
            'isPermanent' => 'required'
        ];
    }
}
