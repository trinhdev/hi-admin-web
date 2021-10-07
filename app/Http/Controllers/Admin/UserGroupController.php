<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UsersGroup;
use App\Models\RoleGroup;
use Illuminate\Http\Request;

class UsersGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get users group with role list
        $roleGroup = new UsersGroup();
        $data = $roleGroup->getRoleListByUsersGroup();
        // Group role by users group
        foreach($data as $item){
            $roleLists[$item->group_code]["group"] = [
                "name" => $item->group_name,
                "code" => $item->group_code,
            ];
            $roleLists[$item->group_code]["data"][] = 
            [
                'role_name'       => $item->role_name,
                'role_code'       => $item->role_code,
                'permission_code' => $item->permission_code
            ]; 
        }

        return view('admin.user-management.role-management',['roleLists' => $roleLists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  $usersGroup
     * @return \Illuminate\Http\Response
     */
    public function show($usersGroup)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UsersGroup  $usersGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(UsersGroup $usersGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UsersGroup  $usersGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UsersGroup $usersGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UsersGroup  $usersGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsersGroup $usersGroup)
    {
        //
    }
}
