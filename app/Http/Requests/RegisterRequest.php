<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RegisterRequest extends FormRequest {
	
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
			'login'    => 'required|alpha_num|min:3|max:255|unique:users,login',
			'email'    => 'required|email|min:3|max:255|unique:users,email',
			'password' => 'required|confirmed|min:3|max:255',
			'policy'   => 'required|accepted',
		];
	}
	
	public function messages()
	{
		return [
			'login.*'    => 'Istnieje już użytkownik o takim loginie.',
			'email.*'    => 'Istnieje już użytkownik o takim adresie email.',
		];
	}
}
