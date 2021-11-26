<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
            'name'          => 'required|unique:products|max:255|min:10',
            'price'         => 'required|numeric',
            'category_id'   => 'required|numeric|gt:0',
            'contents'      => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'         => 'Tên sản phẩm không được để trống',
            'name.unique'           => 'Tên sản phẩm đã tồn tại',
            'name.max'              => 'Tên không quá 255 ký tự',
            'name.min'              => 'Tên ít nhất 10 ký tự',
            'price.required'        => 'Giá sản phẩm không được để trống',
            'price.numeric'         => 'Giá sản phẩm không đúng định dạng',
            'category_id.required'  => 'Chọn danh danh mục sản phẩm',
            'category_id.gt'        => 'Danh mục sản phẩm khác 0',
            'category_id.numeric'   => 'Danh mục sản phẩm không đúng định dạng',
            'contents.required'     => 'Chi tiết sản phẩm không được để trống',
        ];
    }
}
