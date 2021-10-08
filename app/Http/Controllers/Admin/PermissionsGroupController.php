<?php

namespace App\Http\Controllers\Admin;

use App\Models\PermissionsGroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use PDO;

class PermissionsGroupController extends Controller
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
        // Get permissions of current user_group
        $permissionsGroup = new PermissionsGroup();
        $permissionsByGroup = $permissionsGroup->getPermissionListByGroupCode($groupCode);

        if(count($permissionsByGroup->toArray()) == 0){
            return $this->apiJsonResponse("RESPONSE_SUCCESS",[]);
        }

        foreach($permissionsByGroup as $item){
            $data[$item->service_code]["service"] = [
                "name" => $item->service_name,
                "code" => $item->service_code,
            ];
            $data[$item->service_code]["permissions"][] = [
                "permission_name" => $item->permission_name,
                "permission_code" => $item->permission_code,
                "permission_create" => $item->permission_create,
                "permission_read" => $item->permission_read,
                "permission_update" => $item->permission_update,
                "permission_del" => $item->permission_del
            ];
        }
        
        return $this->apiJsonResponse("RESPONSE_SUCCESS",array_values($data));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PermissionsGroup  $PermissionsGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(PermissionsGroup $PermissionsGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PermissionsGroup  $PermissionsGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $params = $request->all();
        $validator = \Validator::make($params,[
            'group_code'                             => 'required',
            'group_name'                             => 'required',
            'data'                                   => 'required',
            'data.*.permissions.*.permission_code'   => 'required',
            'data.*.permissions.*.permission_name'   => 'required',
            'data.*.permissions.*.permission_create' => 'required',
            'data.*.permissions.*.permission_read'   => 'required',
            'data.*.permissions.*.permission_update' => 'required',
            'data.*.permissions.*.permission_del'    => 'required',
        ]);
        if($validator->fails()){
            return $this->apiJsonResponse("RESPONSE_INVALID_INPUT",$validator->messages());
        }
        $roleGroup = new PermissionsGroup();
        $updateData = $roleGroup->updateData($params);
        if(!$updateData){
            return $this->apiJsonResponse("RESPONSE_ERROR",null);
        }
        return $this->apiJsonResponse("RESPONSE_SUCCESS",null);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PermissionsGroup  $PermissionsGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(PermissionsGroup $PermissionsGroup)
    {
        //
    }
}
