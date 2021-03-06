<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class newMessageRequest extends FormRequest
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
        	'user' => 'required|exists:users,id|numeric',
			'topic' => 'required|min:3|max:150',
			'msg' => 'required|min:3',
        ];
    }
}
