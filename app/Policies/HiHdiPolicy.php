<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HiHdiPolicy extends MasterPolicy
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

    public function readAnalysis(){
        return $this->read("HDI_ANALYZE");
    }

    public function updateAnalysis(){
        return $this->update("HDI_ANALYZE");
    }

    public function deleteAnalysis(){
        return $this->delete("HDI_ANALYZE");
    }
}
