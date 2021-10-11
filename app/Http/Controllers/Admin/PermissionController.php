<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\PermissionsGroup;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all permissions
        $permission = new Permission();
        $permissionLists = $permission->getAllPermissions();
        
        // Group permission by service
        foreach($permissionLists as $item) {
            $data[$item->service_code]["service_name"] = $item->service_name;
            $data[$item->service_code]["service_code"] = $item->service_code;
            $data[$item->service_code]["permissions"][] = [
                "permission_code" => $item->permission_code,
                "permission_name" => $item->permission_name,
            ];
        }
        return $this->apiJsonResponse("RESPONSE_SUCCESS",array_values($data));
    }
    
    public function getAllPermissionsAssigned(){
        // Get all permissions
        $permission = new PermissionsGroup();
        $permissionLists = $permission->getAllPermissionsAssigned();
        if(!$permissionLists){
            return back()->withInput(["error" => "There is an error while query data, please try again."]);
        }
        foreach($permissionLists as $item){
            $data[$item->permission_code]["name"] = $item->permission_name;
            $data[$item->permission_code]["code"] = $item->permission_code;
            $data[$item->permission_code]["created_at"] = date("Y-m-d H:i:s",strtotime($item->created_at));
            $data[$item->permission_code]["group"][] = [
                "group_name" => $item->group_name,
                "group_code" => $item->group_code,
            ];
        }
        
        return view('admin.user-management.permission-management',['permissionList' => array_values($data)]);
    }
   
    public function getAllPermissions()
    {
        $permission = new Permission();
        $data = $permission->getAllPermissionsNotAssigned();
        return $this->apiJsonResponse("RESPONSE_SUCCESS",$data);
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
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
