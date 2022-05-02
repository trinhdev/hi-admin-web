<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IconCategorySaveRequest extends FormRequest
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
            'productTitleNameVi'    => 'required|max:50',
            'productTitleNameEn'    => 'max:50',
            'arrayId'               => 'required',
            'description'           => 'max:120'
        ];
    }

    public function messages()
{
    return [
        'productTitleNameVi.required'   => 'Tên danh mục không được để trống',
        'productTitleNameVi.max'        => 'Tên danh mục chỉ giới hạn trong 50 ký tự',
        'productTitleNameEn.max'        => 'Tên danh mục chỉ giới hạn trong 50 ký tự',
        'arrayId.required'              => 'Xin vui lòng chọn sản phẩm cho danh mục',
        'description'                   => 'Mô tả chỉ giới hạn trong 120 ký tự'
    ];
}
}
