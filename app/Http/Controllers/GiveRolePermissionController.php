<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class GiveRolePermissionController extends Controller
{
    public function ShowPermission($id)
    {

        $role = Role::findorfail($id);
        $rolePermissions = $role->Permissions;

        $permissions  = Permission::where('guard_name', $role->guard_name)->get();

        foreach ($permissions as $permission) {
            $permission->setAttribute('assigned', false);

            foreach ($rolePermissions as $rolePermission) {

                if ($rolePermission->id == $permission->id) {

                    $permission->setAttribute('assigned', true);
                    break;
                }
            }
        }

        return response()->json([
            'permission' => $permissions
        ]);
    }
}
