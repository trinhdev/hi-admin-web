<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FtelPhoneRequest extends FormRequest
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
            'number_phone' => [
                function ($attribute,$value, $fail){
                    $arrPhone = explode(',',$value);
                    $pattern = '/^(03|05|07|08|09)[0-9, ]*$/';
                    if (is_array($arrPhone) || is_object($arrPhone))
                    {
                        if(count($arrPhone) > 1000) {
                            return $fail("Không được nhập quá giới hạn 1000 số, nếu cần gấp vui lòng liên hệ email kĩ thuật phucnh74@fpt.com.vn !");
                        }
                        foreach ($arrPhone as $arPhone) {
                            $phone = trim($arPhone);
                            if ((strlen($phone)==0)) {
                                return $fail('Hãy chắc chắn không nhập dư dấu "," trong dãy số điện thoại!');
                            }
                            if ((strlen($phone)!==10)) {
                                return $fail("Trường $phone phải đúng 10 kí tự");
                            }                            
                            if(!preg_match($pattern, $phone)) {
                                return $fail("Trường $phone sai định dạng số điện thoại Việt Nam");
                            }
                        }
                    } else {
                        return $fail("Trường $attribute sai định dạng");
                    }
                }
            ]
        ];
    }
}
