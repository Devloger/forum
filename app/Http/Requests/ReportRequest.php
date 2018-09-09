<?php

namespace App\Http\Requests;

use App\Models\Posts;
use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    public function authorize()
    {
        return Posts::where('id', $this->post)->count();
    }

    public function rules()
    {
        return [
            'post' => 'required|numeric|exists:posts,id',
            'report_content' => 'required|max:255|min:5',
        ];
    }
}
