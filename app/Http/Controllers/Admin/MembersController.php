<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class MembersController extends Controller
{
    public $params;
    public function __contruct(Request $request){
        parent::__contruct($request);
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
        return view('admin.user-management',['users' => $result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // if(!$this->authorize('create-user')) {
        //     abort(403);
        // }

        if($request->getMethod() == "GET") {
            return view('admin.user-create');
        }

        $validator = Validator::make($request->all(),[
            'username' => 'required',
            'name'     => 'required|min:20',
            'email'     => 'required|email',
            'group_id'     => 'required|numeric',
            'password'     => 'required|min:8',
        ]);

        // Quay về trang trước và thông báo lỗi nếu validate fail
        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
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
            return back()->withErrors("There is an error while creating user!");
        }

        return redirect()->route('admin.user_list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            'group_id' => 'required',
            'name'     => 'required',
            'username' => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:6'
        ]);

        if($validator->fails()){
            return redirect()->route('admin.user_create')
            ->withErrors($validator)
            ->withInput();
        }


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
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        if($this->authorize('update-user', User::class)){
            // dd(view('user.user-edit'));
            return view('admin.user-edit',['user'=>$user]);
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
        //
        $validator = Validator::make($request->all(),[
            'group_id' => 'required',
            'name'     => 'required|min:20',
        ]);
        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        }

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
