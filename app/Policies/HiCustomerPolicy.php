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

    public function updateOTP(){
        return $this->update("OTP");
    }

    public function deleteOTP(){
        return $this->delete("OTP");
    }
}
