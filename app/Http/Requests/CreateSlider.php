<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSlider extends FormRequest
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
            'name' => 'required|max:255|min:10',
            'description' => 'required',
            'image_path'    => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'         => 'Tiêu đề slider không được để trống',
            'name.max'              => 'Tiêu đề slider quá không quá 255 ký tự',
            'name.min'              => 'Tiêu đề slider ít nhất  10 ký tự',
            'description.required'  => 'Mô tả slider không được để trống',
            'image_path.required'   => 'Ảnh mô tả sản phẩm không được để trống',
        ];
    }
}
