<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Traits\DataTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    use DataTrait;
    public function changePassword(ChangePasswordRequest $request)
    {
        //     if(Hash::check($request->current_password,Auth::user()->password)){
        //         $paramUpdate = [
        //             'password'=>Hash::make($request->password)
        //         ];
        //         $this->updateById(new User(),Auth::user()->id,$paramUpdate);
        //         return redirect()->back()->withSuccess('Success');
        //     }else{
        //         return redirect()->back()->withErrors('Fail');
        //     }
        // }
        $paramUpdate = [
            'password' => Hash::make($request->password)
        ];
        $this->updateById(new User(), Auth::user()->id, $paramUpdate);
        return redirect()->back();
    }
}
