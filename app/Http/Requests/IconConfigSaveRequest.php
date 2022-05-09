<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IconConfigSaveRequest extends FormRequest
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
            'name'          => 'required',
            'iconsPerRow'   => 'required|numeric|min:0|not_in:0',
            'rowOnPage'     => 'required|numeric|min:0|not_in:0'
        ];
    }

    public function messages()
{
    return [
        'titleVi.required'      => 'Tên cấu hình không được để trống',
        'iconUrl.required'      => 'Tên cấu hình - code không được để trống',
        'iconsPerRow.required'  => 'Số icon trên 1 dòng không được để trống',
        'iconsPerRow.numeric'   => 'Số icon trên 1 dòng phải là số',
        'iconsPerRow.not_in'    => 'Số icon trên 1 dòng phải lớn hơn 0',
        'rowOnPage.required'    => 'Số dòng tối đa không được để trống',
        'rowOnPage.required'    => 'Số dòng tối đa không được để trống',
        'rowOnPage.not_in'      => 'Số dòng tối đa phải lớn hơn 0',
    ];
}
}
