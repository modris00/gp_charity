<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Permission::class, 'permission');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Permission::class);

        $data = Permission::all();
        return new Response(['status' => true, 'data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Permission::class);

        $validator = Validator($request->all(), [
            'name' => 'required|string|max:30',
            'guard_name' => 'required|string|in:admin-api',
        ]);

        if (!$validator->fails()) {
            $permission = Permission::create($request->all());
            return new Response(['status' => !is_null($permission), 'object' => $permission]);
        } else {
            return new Response(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        $this->authorize('view', $permission);

        return response()->json(['status' => true, 'object' => $permission]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $this->authorize('update', $permission);

        $validator = Validator($request->all(), [
            'name' => 'required|string|max:30',
            'guard_name' => 'required|string|in:admin,donor,beneficiary',
        ]);

        if (!$validator->fails()) {
            // $role = Permission::create($request->all());
            $permission->name = $request->input('name');
            $permission->guard_name = $request->input('guard_name');
            $saved = $permission->save();
            return new Response(['status' => $saved, 'object' => $permission]);
        } else {
            return new Response(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $this->authorize('delete', $permission);

        $deleted = $permission->delete();
        return response()->json(
            [
                'status' => $deleted,
                'message' => $deleted ? 'Deleted successfully' : 'Delete failed'
            ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }

    // $this->authorize('restore', $permission);
    // $this->authorize('forceDelete', $permission);
}
