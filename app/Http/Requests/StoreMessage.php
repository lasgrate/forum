<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessage extends FormRequest
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
            'fake_name' => 'required|string|max:255',
            'text' => 'required|string',
            'created_at' => 'required|string',
            'is_enable' => 'boolean',
        ];
    }

    public function attributes()
    {
        return [
            'fake_name' => __('partner.messages.fake_name'),
            'text' => __('partner.messages.text'),
            'created_at' => __('partner.messages.created_at'),
            'is_enable' => __('partner.messages.is_enable'),
        ];
    }
}
