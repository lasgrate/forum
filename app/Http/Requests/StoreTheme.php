<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTheme extends FormRequest
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
			'forum_id' => 'required|integer',
			'name' => 'required|string|max:255',
			'description' => 'required|string',
			'created_at' => 'required|date_format:"Y-m-d H:i:s"',
			'is_enable' => 'boolean',
			'tag.*' => 'integer',
		];
	}

	public function attributes()
	{
		return [
			'forum_id' => __('partner.forums.heading_title'),
			'name' => __('partner.themes.name'),
			'description' => __('partner.themes.description'),
			'created_at' => __('partner.themes.created_at'),
			'tag.*' => __('partner.tags.heading_title'),
		];
	}
}
