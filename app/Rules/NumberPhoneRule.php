<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NumberPhoneRule implements Rule
{
    /**
     * @var int
     */
    private $limit;
    /**
     * @var string
     */
    private $email;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function __construct()
    {
        $this->limit = 1000000;
        $this->email = EMAIL_FTEL_PHONE;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $arrPhone = explode(',',$value);
        $pattern = '/^(03|05|06|07|08|09)[0-9, ]*$/';
        if (!is_array($arrPhone) && !is_object($arrPhone) || count($arrPhone) > $this->limit) {
            return false;
        }

        foreach ($arrPhone as $arPhone) {
            $phone = trim($arPhone);
            if ((strlen($phone)!==10) || !preg_match($pattern, $phone)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute sai định dạng số điện thoại hoặc quá '. $this->limit .' số';
    }
}
