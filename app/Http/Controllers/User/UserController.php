<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public $params;
    public $curUser;
    public function __contruct(Request $request){
        parent::__contruct($request);
        $this->params = $request->all();
    }
  
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user = null)
    {
        $user = ($user) ? $user : Auth::user();
        if($this->authorize('view-user', $user)){
            return view('user.profile',['user' => $user]);
        }
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // Kiểm tra quyền thưc thi của user
        if(!$this->authorize('update-user', User::class)){
            abort(403);
        }

        // Validate input
        $validator = Validator::make($request->all(),[
            'group_id' => 'required',
            'name'     => 'required|min:20',
        ]);
        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        }

        $checkSave = User::where('user_id',$user->user_id)
                            ->update([
                                    'group_id'  => $request['group_id'],
                                    'name'      => $request['name']
                                ]);
        if(!$checkSave){
            return back()
            ->withErrors("There is an error while update user!");
        }

        return redirect()->route('profile',['user' => $user->user_id ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
