<?php

namespace App\Http\Requests\GetPhoneNumberRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'excel' => 'mimes:xlsx,csv',
            'excel.mimes' => 'Sai định dạng file, chỉ chấp nhận file có đuôi .xlsx hoặc csv'
        ];
    }
}
