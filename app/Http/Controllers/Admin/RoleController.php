<?php

namespace App\Http\Controllers\Admin;


use App\DataTables\Admin\RolesDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\BaseController;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleController extends BaseController
{

    function __construct()
    {
        parent::__construct();
        $this->title = 'Quản lí phân quyền';
        $this->middleware('permission:Role-view|Role-create|Role-edit|Role-delete', ['only' => ['index','store']]);
        $this->middleware('permission:Role-create', ['only' => ['create','store']]);
        $this->middleware('permission:Role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Role-delete', ['only' => ['destroy']]);
    }

    public function index(RolesDataTable $dataTable, Request $request)
    {
        return $dataTable->render('roles.index2');
    }

    public function create()
    {
        $permission = [];
        $abc = '';
        $per = Permission::get();
        foreach ($per as $value) {
            $sub = explode('-', $value->name);
            if ($abc != $sub[0] && !empty($sub[1])) {
                $permission[$sub[0]][$value->id]=$sub[1];
            }
        }
        return view('roles.create',compact('permission'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permissions' => 'required'
        ]);
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permissions'));

        return redirect()->back()
            ->with('success','Role created successfully');
    }

    public function show($id)
    {
        return redirect()->route('roles.index');
    }

    public function edit($id)
    {
        $role = Role::find($id);
        if($role->name == 'super-admin'){
            $notification = array(
                'danger' => 'danger',
                'message' => "You have no permission for edit this role"
            );
            return redirect()->route('role.index')->with($notification);
        }

        $permission = [];
        $abc = '';
        $per = Permission::get();
        foreach ($per as $value) {
            $sub = explode('-', $value->name);
            if ($abc != $sub[0] && !empty($sub[1])) {
                $permission[$sub[0]][$value->id]=$sub[1];
            }
        }
        $rolePermissions = DB::table("role_has_permissions")
            ->where("role_id",$id)
            ->pluck('permission_id')
            ->toArray();
        return view('roles.edit2',compact('role','permission','rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => [
                'required',
                Rule::unique('roles','name')->ignore($id)
            ],
            'permissions' => 'required'
        ]);
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permissions'));

        return redirect()->route('role.index')
            ->withSuccess(['message','Role updated successfully']);
    }

    public function destroy(Request $request)
    {
//        $users_role = User::role($request->role_name)->get();
//        foreach ($users_role as $user) {
//            $user->removeRole($request->role_name);
//        }
//        return response(['success'=>'Success']);
    }
}
