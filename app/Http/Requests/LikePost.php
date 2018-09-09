<?php

namespace App\Http\Requests;

use App\Models\Posts;
use App\Models\Reputations;
use Illuminate\Foundation\Http\FormRequest;

class LikePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !Reputations::where('post', $this->post)->where('from', auth()->user()->id)->first() AND Posts::where('id', $this->post)->first()->author != auth()->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'post' => 'required|numeric',
        ];
    }
}
