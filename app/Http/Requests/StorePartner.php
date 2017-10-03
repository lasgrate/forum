<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class StorePartner extends FormRequest
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
	 * @param Route $route
	 * @return array
	 */
	public function rules(Route $route)
	{
		list(, $method) = explode('@', $route->getActionName());

		$emailValidationRules = 'required|string|email|max:96';

		if ($method == 'store') {
			$emailValidationRules .= '|unique:users';
		}

		return [
			'email' => $emailValidationRules,
			'name' => 'required|string|max:32|',
			'password' => 'required|string|min:6|confirmed',
		];
	}

	public function attributes()
	{
		return [
			'email' => __('admin.partners.email'),
			'name' => __('admin.partners.name'),
			'password' => __('admin.partners.password'),
		];
	}
}
