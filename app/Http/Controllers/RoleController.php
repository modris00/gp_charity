<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    // public function __construct()
    // {
    //     $this->authorizeResource(Role::class, 'role');
    // }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Role::class);

        $data = Role::all();
        return new Response(['status' => true, 'data' => $data]);
    }

    public function updateRolePermission(Request $request, Role $role, Permission $permission)
    {
        if ($role->guard_name == $permission->guard_name) {
            if ($role->hasPermissionTo($permission)) {
                $role->revokePermissionTo($permission);
            } else {
                $role->givePermissionTo($permission);
            }
            return new Response(['status' => true], Response::HTTP_OK);
        } else {
            return new Response(['message' => 'Role & permission not for the same guard'], Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Role::class);

        $validator = Validator($request->all(), [
            'name' => 'required|string|max:30',
            'guard_name' => 'required|string|in:admin,donor,beneficiary',
        ]);

        if (!$validator->fails()) {
            $role = Role::create($request->all());
            return new Response(['status' => !is_null($role), 'object' => $role]);
        } else {
            return new Response(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $this->authorize('view', $role);

        return response()->json(['status' => true, 'data' => $role]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $this->authorize('update', $role);

        $validator = Validator($request->all(), [
            'name' => 'required|string|max:30',
            'guard_name' => 'required|string|in:admin',
        ]);

        if (!$validator->fails()) {
            // $role = Role::create($request->all());
            $role->name = $request->input('name');
            $role->guard_name = $request->input('guard_name');
            $saved = $role->save();
            return new Response(['status' => $saved, 'message' => "Role Updated", 'object' => $role]);
        } else {
            return new Response(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $this->authorize('delete', $role);

        $deleted = $role->delete();
        return response()->json(
            [
                'status' => $deleted,
                'message' => $deleted ? 'Deleted successfully' : 'Delete failed'
            ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }

    // $this->authorize('restore', $role);
    // $this->authorize('forceDelete', $role);

}
