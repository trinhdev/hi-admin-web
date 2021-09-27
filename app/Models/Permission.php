<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
class Permission extends Model
{
    public $userId;
    public function __construct(){
        $this->userId = Auth::user()->user_id;
    }
    //
    public function getUserPermissions(){
        $result = Permission::where('user_id', $this->userId)
                                                        ->where('permitted',1)
                                                        ->pluck('permission_code')->toArray();
        return $result;
    }
}
