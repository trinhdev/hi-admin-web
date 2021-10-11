<?php

namespace App\Http\Controllers\Admin;

use App\Models\PermissionsGroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\UsersGroup;
class PermissionsGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get users group with role list
        $PermissionsGroup = new UsersGroup();
        $data = $PermissionsGroup->getRoleListByUsersGroup();
        return view('admin.user-management.role-management',['roleLists' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllUsersGroup()
    {
        $usersGroup = new UsersGroup();
        $data = $usersGroup->getAllUsersGroup();
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
        $params = $request->all();
        $validator = \Validator::make($params,[
            "group_name"                           => 'required',
            "data"                                 => 'required',
            "data.*.permissions.*.permission_code" => 'required'
        ]);
        if($validator->fails()){
            return $this->apiJsonResponse("RESPONSE_INVALID_INPUT",$validator->messages());
        }
        $dataSave = [
            "group_name" => $params["group_name"],
            "group_code" => str_replace(" ","_",strtoupper($params["group_name"]))
        ];
        $group = new UsersGroup();
        $checkSave = $group->saveData($dataSave["group_name"],$dataSave["group_code"]);
        if(!$checkSave){
            return $this->apiJsonResponse("RESPONSE_ERROR",null);
        }

        foreach($params["data"] as $service){
            foreach($service["permissions"] as $item){
                if(count($item) > 2){
                    $dataSave["data"][] = [
                        "group_code"        => $dataSave["group_code"],
                        "service_code"      => $service["service_code"],
                        "permission_code"   => $item["permission_code"],
                        "permission_create" => (isset($item["permission_create"]) ? $item["permission_create"] : 0),
                        "permission_read"   => (isset($item["permission_read"]) ? $item["permission_read"] : 0),
                        "permission_update" => (isset($item["permission_update"]) ? $item["permission_update"] : 0),
                        "permission_del"    => (isset($item["permission_del"]) ? $item["permission_del"] : 0),
                    ];
                }
            }
        }

        $permissionGroup = new PermissionsGroup();
        $checkSave = $permissionGroup->saveNewPermissionGroup($dataSave["data"]);
        if(!$checkSave){
            return $this->apiJsonResponse("RESPONSE_ERROR",null);
        }
        return $this->apiJsonResponse("RESPONSE_SUCCESS",$checkSave);
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

    // View roleDetail
    public function viewRoleDetail($groupCode) {
        // Get permissions of current user_group
        $permissionsGroup = new PermissionsGroup();
        $permissionsByGroup = $permissionsGroup->getPermissionListByGroupCode($groupCode);

        if(count($permissionsByGroup->toArray()) == 0){
            return $this->apiJsonResponse("RESPONSE_SUCCESS",[]);
        }
        foreach($permissionsByGroup as $item){
            $data["roleDetail"]["group"] = [
                "group_name"      => $item->group_name,
                "group_code"      => $item->group_code
            ];
            $data["roleDetail"]["permissions"][] = [
                "permission_name" => $item->permission_name,
                "permission_code" => $item->permission_code,
                "permission_create" => $item->permission_create,
                "permission_read" => $item->permission_read,
                "permission_update" => $item->permission_update,
                "permission_del" => $item->permission_del
            ];
        }

        $usersGroup = new UsersGroup();
        $usersInGroup = $usersGroup->getUsersByGroupCode($groupCode);
        $data["users"] = $usersInGroup;
        return view("admin.user-management.role-detail",['data' => $data]);
    }
    
    public function assignPermissionToGroup(Request $request){
        $params = $request->all();
        $validator = \Validator::make($params,[
            'permission_code'                        => 'required',
            'group_assigned'                             => 'required',
        ]);
        if($validator->fails()){
            return $this->apiJsonResponse("RESPONSE_INVALID_INPUT",$validator->messages());
        }
        
        $permission = new Permission();
        $checkExist = $permission->getPermissionInfoByPermissionCode($request["permission_code"]);
        if(!$checkExist){
            return $this->apiJsonResponse("RESPONSE_INVALID_INPUT",null,"Permission isn't exist!");
        }

        $permissionGroup = new PermissionsGroup();
        foreach($params["group_assigned"] as $item){
            $dataSave[] = [
                "permission_code" => $params["permission_code"],
                "service_code"    => $checkExist->service_code,
                "group_code"      => $item,
            ];
        } 
        $checkSave = $permissionGroup->assignPermissionToGroup($dataSave);
        if(!$checkSave){
            return $this->apiJsonResponse("RESPONSE_ERROR",null);
        }

        return $this->apiJsonResponse("RESPONSE_SUCCESS",null);
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
