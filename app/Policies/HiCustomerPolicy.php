<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class HiCustomerPolicy extends MasterPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        parent::__construct();
    }


    public function readOTP(){
        return $this->read("OTP");
    }

    public function writeOTP(){
        return $this->write("OTP");
    }

    public function destroyOTP(){
        return $this->destroy("OTP");
    }
}
