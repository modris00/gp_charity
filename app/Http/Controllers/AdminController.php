<?php

namespace App\Http\Controllers;

use App\Http\Resources\AdminResource;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{

    // public function __construct()
    // {
    //     $this->authorizeResource(Admin::class, 'admin');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Admin::class);

        $admins = Admin::paginate(10); //Pagination
        $data = AdminResource::collection($admins);
        return response()->json(['status' => 'success', 'message' => 'success', 'data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Admin::class);

        // validate
        $valid = validator($request->all(), [
            'username' => 'required|string|min:2|max:20|unique:admins,username',
            'email' => 'required|string|email|unique:admins,email',
            'password' => ['required', Password::min(7)->symbols()->letters()->uncompromised()],
        ]);

        // store
        if (!$valid->fails()) {
            // Eloquent
            $admin = new Admin();
            $admin->username = $request->input('username');
            $admin->email = $request->input('email');
            $admin->password = Hash::make($request->input('password'));
            $saved = $admin->save();
            if ($saved) {
                $role = Role::findById(1); //Super Admin
                $admin->assignRole($role);
            }
            return new Response(
                ['data' => $admin, 'message' => $saved ? 'Created Admin Successfully' : 'Created Admin Failed!'],
                $saved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return new Response(['message' => $valid->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Show Resource
     */
    public function show(Admin $admin)
    {
        $this->authorize('view', $admin);
        return new AdminResource($admin);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admin = Admin::findOrFail($id);
        $this->authorize('update', $admin);
        // validate
        $valid = validator($request->all(), [
            'username' => 'required|string|min:2|max:20',
            'email' => 'required|string|email',
        ]);

        // store
        if (!$valid->fails()) {
            // Eloquent
            $admin = Admin::findOrFail($id);
            $admin->username = $request->input('username');
            $admin->email = $request->input('email');
            $update = $admin->save();
            return new Response(
                ['data' => $admin, 'message' => $update ? 'Updated Admin Successfully' : 'Updated Admin Failed!'],
                $update ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return new Response(['message' => $valid->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        // $admin = Admin::findOrFail($id);
        $this->authorize('delete', $admin);

        $deleted = $admin->delete();
        return new Response(
            [
                "message" => $deleted ? "Successfully deleted" : "Failed deleted!"
            ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Request $request, $id): Response
    {
        $admin = Admin::findOrFail($id);
        $this->authorize('restore', $admin);

        $admin = Admin::onlyTrashed()->findOrFail($id);
        $restored = $admin->restore();
        return new Response(['status' => $restored]);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Request $request, $id): Response
    {
        $admin = Admin::withTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $admin);

        $deleted = $admin->forceDelete();
        return new Response(['status' => $deleted]);
    }
}
