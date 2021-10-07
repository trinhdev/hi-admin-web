<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    public $params;
    public function __construct(Request $request){
        parent::__construct($request);
        $this->params = $request->all();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Make default page size is 10
        $perPage = (!empty($this->params['perPage'])) ? $this->params['perPage'] : 10;
        $user = new User();
        $result = $user->getAllUsers($perPage);
        return view('admin.user-management.user-list',['users' => $result]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(),[
            'username' => 'required',
            'name'     => 'required',
            'email'     => 'required|email',
            'group_id'     => 'required|numeric',
            'password'     => 'required|min:8',
        ]);

        // Quay về trang trước và thông báo lỗi nếu validate fail
        if($validator->fails()){
            return $this->apiJsonResponse("RESPONSE_INVALID_INPUT",null,$validator->messages());
        }

        $checkSave = User::create([
            'username'      => $request['username'],
            'name'          => $request['name'],
            'email'         => $request['email'],
            'group_id'      => $request['group_id'],
            'password'      => \Hash::make($request['password'])
        ]);

        // Nếu trong quá trình query xảy ra lỗi thì quay về trang trước và thông báo lỗi
        if(!$checkSave){
            return $this->apiJsonResponse("RESPONSE_ERROR",null);
        }

        return $this->apiJsonResponse("RESPONSE_SUCCESS",null);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        return view('admin.user-management.user-profile',['user'=>$user]);
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
        // Validate input
        $validator = Validator::make($request->all(),[
            'group_id' => 'string|numeric',
            'name'     => 'string',
            'username' => 'string',
            'password' => 'string|min:8',
            'enabled'  => 'numeric|in:1,0'
        ]);

        if($validator->fails()){
            return $this->apiJsonResponse("RESPONSE_INVALID_INPUT",null,$validator->messages());
        }
        
        // Format params before update
        $params = array();
        foreach($request->all() as $key => $item){
            if(!empty($item)){
                $params[$key] = $item;
            }
        }

        // Update user model
        $user = new User();
        $result = $user->updateUserByParams($user->user_id,$params);
        if(!$result){
            return $this->apiJsonResponse("RESPONSE_ERROR",null);
        }
        return $this->apiJsonResponse("RESPONSE_SUCCESS",null);
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
