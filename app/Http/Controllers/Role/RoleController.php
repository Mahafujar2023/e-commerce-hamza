<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
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
        try {
            $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                    Rule::unique('permissions')->where(function ($query) {
                        return $query->where('guard_name', 'web');
                    }),
                ],
            ]);

            $permission = Permission::create([
                'name' => $request->name,
                'guard_name' => 'web',
            ]);

            return back()->with('message', 'Permission created successfully');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors()->all())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong');
        }
    }

    public function permissionUpdate(Request $request, $id)
    {
        try {
            $permission = Permission::findOrFail($id);

            $request->validate([
                'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
            ]);

            $permission->update([
                'name' => $request->name,
            ]);

            return back()->with('message', 'Permission updated successfully');
        } catch (ValidationException $e) {
            return back()->withErrors($e->validator->errors()->all())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong');
        }
    }

    public function deletePermission($id)
    {
        try {
            $permission = Permission::findOrFail($id);
            $permission->delete();

            return back()->with('message', 'Permission deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong');
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

    public function roleIndex()
    {
        $roles = Role::all();
        return view('backend\pages\role\index', compact('roles'));
    }

    //permission index 
    public function permissionIndex()
    {
        $permissions = Permission::all();
        return view('backend\pages\role\permissions', compact('permissions'));
    }

    public function hasPermissionsPage($roleId) {
        $role = Role::findOrFail($roleId);
        $permissions = Permission::all();
        return view('backend.pages.role.role-has-permissions',compact('role','permissions' ));
    }

    public function saveRolePermissions(Request $request, $roleId)
{
    $role = Role::findOrFail($roleId);
    $permissions = $request->input('permissions', []);

    $role->syncPermissions($permissions);

    // Redirect back or to another page after saving
    return redirect()->back()->with('message', 'Permissions updated successfully');
}

}
