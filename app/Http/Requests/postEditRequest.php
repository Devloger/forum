<?php

namespace App\Http\Requests;

use App\Models\Posts;
use Illuminate\Foundation\Http\FormRequest;

class postEditRequest extends FormRequest {
	
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$post = Posts::findOrFail($this->pid);
		
		return ( auth()->check() AND $post->author === auth()->user()->id AND $post->topics->status === 1 AND $post->topics->sections->status === 1 ) OR ( auth()->user()->haveSectionRights($post->topics->sections) );
	}
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'pid'  => 'required|numeric|exists:posts,id',
			'post' => 'required|min:2',
		];
	}
}
