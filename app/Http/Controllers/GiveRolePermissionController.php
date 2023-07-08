<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
            'data' => $permissions
        ]);
    }

    public function updateRolePermission(Request $request, Role $role, Permission $permission)
    {
        if ($role->guard_name == $permission->guard_name) {
            if ($role->hasPermissionTo($permission)) {
                $role->revokePermissionTo($permission);
                return new Response(['message' => "The Permission has been revoked"  ], Response::HTTP_OK);
            } else {
                $role->givePermissionTo($permission);
                return new Response(['message' => "Permission has been granted successfully" ], Response::HTTP_OK);
            }
           
        } else {
            return new Response(['message' => 'Role & permission not for the same guard'], Response::HTTP_BAD_REQUEST);
        }
    }

    
}
