<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddSettingRequest extends FormRequest
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
            'config_key'    => 'required|max:255|min:10',
            'config_value'  => 'required|max:255|min:10',
        ];
    }

    public function messages()
    {
        return [
            'config_key.required'       => 'Config key không được để trống',
            'config_key.max'            => 'Config key không quá 255 ký tự',
            'config_key.min'            => 'Config key ít nhất 10 ký tự',
            'config_value.required'     => 'config value không được để trống',
            'config_value.max'          => 'config value không quá 255 ký tự',
            'config_value.min'          => 'config value ít nhất 10 ký tự',
        ];
    }
}
