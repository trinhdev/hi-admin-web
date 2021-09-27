<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CheckOTPController extends Controller
{
    public $params;
    public function __contruct(Request $request){
        parent::__contruct($request);
        $this->params = $request->all();
    }

    public function index(User $user = null)
    {
        $us = Auth::user();
        if($us->group_id == 2){
            //Make default page size is 10
            $perPage = (!empty($this->params['perPage'])) ? $this->params['perPage'] : 10;
            $us = new User();
            $result = $us->getAllUsers($perPage);
            return view('admin.checkOTP',[
                'users' => $result,
                'account'=>'admin'
            ]);
        }
        if($this->authorize('view-user', $user)){
            return view('user.checkOTP',[
                'user' => $user,
                'account'=>'user'
            ]);
        }
        abort(403);
    }
}
