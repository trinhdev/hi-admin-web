<?php

namespace App\Http\Controllers\Admin;

use App\Models\RoleGroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
class RoleGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get role group list
        
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

    public function show($groupCode)
    {
        // Get role of current user_group
        $roleGroup = new RoleGroup();
        $rolesByGroup = $roleGroup->getRoleListByGroupCode($groupCode);
        foreach($rolesByGroup as $role){
            $data["group"][$role->service_code]["service"] = $role->service_name;
            $data["group"][$role->service_code]["data"][$role->role_code][] = [
                "rolePermission" => $role->rolePermission,
                "roleName"       => $role->role_name,
            ];
        }
        // Get current permission list
        $permission = new Permission();
        $permissionList = $permission->getAllPermissions();
        foreach($permissionList as $permission){
            $data["permission"][$permission->service_code]["service"] = $permission->service_name;
            $data["permission"][$permission->service_code]["data"][$permission->role_code][] = [
                "roleCode"       => $permission->permission_code,
                "roleName"       => $permission->role_name,
            ];
        }
        

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoleGroup  $roleGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(RoleGroup $roleGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RoleGroup  $roleGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoleGroup $roleGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoleGroup  $roleGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoleGroup $roleGroup)
    {
        //
    }
}
