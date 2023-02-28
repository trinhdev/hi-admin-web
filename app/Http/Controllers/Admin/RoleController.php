<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{

    function __construct()
    {
//        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
//        $this->middleware('permission:role-create', ['only' => ['create','store']]);
//        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $roles = Role::orderBy('id','DESC')->paginate(5);
        return view('roles.index',compact('roles'));
    }

    public function create()
    {
        $permission = [];
        $abc = '';
        $per = Permission::get();
        foreach ($per as $value) {
            //$sub = substr($value->name, 0, strpos($value->name, "-"));
            $sub = explode('-', $value->name);
            if ($abc != $sub[0] && !empty($sub[1])) {
                $permission[$sub[0]][$value->id]=$sub[1];
            }
        }
//        Permission::create(['name' => 'checklistmanage-view']);
//        Permission::create(['name' => 'checklistmanage-create']);
//        Permission::create(['name' => 'checklistmanage-edit']);
//        Permission::create(['name' => 'checklistmanage-import']);
//        Permission::create(['name' => 'checklistmanage-export']);
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
        if($role->name == 'Super-Admin'){
            $notification = array(
                'message' => "You have no permission for edit this role",
                'alert-type' => 'error'
            );
            return redirect()->route('roles.index')
                ->with($notification);
        }

        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('roles.edit',compact('role','permission','rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => [
                'required',
                Rule::unique('roles','name')->ignore($id)
            ],
            'permission' => 'required'
        ]);
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
            ->with('success','Role updated successfully');
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        if (auth()->user()->roles->find($id)) {
            $notification = array(
                'message' => 'You have no permission for delete this role',
                'alert-type' => 'error'
            );
            return redirect()->route('roles.index')
                ->with($notification);
        }
        if ($role->name == "Super-Admin"){
            $notification = array(
                'message' => 'You have no permission for delete Super-Admin role',
                'alert-type' => 'error'
            );
            return redirect()->route('roles.index')
                ->with($notification);
        }
        $role->delete();

        $notification = array(
            'message' => 'The role deleted successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('roles.index')
            ->with($notification);
    }
}
