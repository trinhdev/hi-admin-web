<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IconSaveRequest extends FormRequest
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
            'productNameVi'         => 'required|max:50',
            'productNameEn'         => 'max:50',
            'decriptionVi'          => 'max:120',
            'iconUrl'               => 'required',
            'dataActionStaging'     => 'required',
            'dataActionProduction'  => 'required',
        ];
    }

    public function messages()
{
    return [
        'productNameVi.required'        => 'Tên sản phẩm không được để trống',
        'productNameVi.max'             => 'Tên sản phẩm không được quá 50 ký tự',
        'productNameEn.max'             => 'Tên sản phẩm không được quá 50 ký tự',
        'decriptionVi.max'             => 'Mô tả phẩm không được quá 50 ký tự',
        'iconUrl.required'              => 'Xin vui lòng upload hình ảnh của sản phẩm',
        'dataActionStaging.required'    => 'Link Staging không được để trống',
        'dataActionProduction.required' => 'Link Production không được để trống',
    ];
}
}
