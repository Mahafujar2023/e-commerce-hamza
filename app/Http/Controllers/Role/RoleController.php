<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function createRole(Request $request)
    {
        $role = Role::create(['name' => $request->role_name]);

        return response()->json($role);
    }

    public function createPermission(Request $request)
    {
        $permission = Permission::create([
            'name' => $request->name,
            'guard_name' => 'web',
     ]);

     if ($permission) {
        return redirect()->back()->with('message', 'Permission created successfully');
     } else
     {
        return back()->with('error', 'Somthing went wront');
     }
       
    }

    public function assignPermissionToRole(Request $request)
    {
        $role = Role::find($request->role_id);
        $permission = Permission::find($request->permission_id);

        $role->givePermissionTo($permission);

        return response()->json(['message' => 'Permission assigned to role successfully']);
    }

    public function assignUserToRole(Request $request)
    {
        $user = User::find($request->user_id);
        $role = Role::find($request->role_id);

        $user->assignRole($role);

        return response()->json(['message' => 'User assigned to role successfully']);
    }

    //view pages

    public function roleIndex(){
        $roles = Role::all();
        return view('backend\pages\role\index', compact('roles'));
    }

    //permission index 
    public function permissionIndex(){
        $permissions = Permission::all();
        return view('backend\pages\role\permissions', compact('permissions'));
    }
}
