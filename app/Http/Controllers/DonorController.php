<?php

namespace App\Http\Controllers;

use App\Http\Resources\DonorResource;
use App\Http\Resources\DonorResourceCollection;
use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny' ,  Donor::class);
        // $donor = Donor::latest()->Paginate(10);
        $donor = Donor::all();
        return new DonorResourceCollection($donor);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create' ,  Donor::class);

        $valditor = validator($request->all(), [

            'name' => ['required', 'string', 'min:2', 'max:45'],
            'phone' => ['required', 'digits:9', 'numeric', 'unique:donors,phone'],
            'username' => ['required', 'string', 'unique:donors,username'],
            'email' => ['required', 'string', 'email', 'unique:donors,email'],
            'password' => ['required', Password::min(8)->symbols()->letters()->uncompromised()],
            'area_id' => ['required', 'int', 'exists:areas,id']

        ]);

        if (!$valditor->fails()) {

            $donor = new Donor();
            $donor->name = $request->input('name');
            $donor->phone = $request->input('phone');
            $donor->username = $request->input('username');
            $donor->email = $request->input('email');
            $donor->password = Hash::make($request->input('password'));
            $donor->area_id = $request->input('area_id');
            $saved = $donor->save();
            if ($saved) {
                $role = Role::findById(3, 'donor'); //User-Donor
                $donor->assignRole($role);
            }
            return new Response([
                'object' => $donor,
                'message' => $donor ? 'Created successfuly' : 'error adding',
                'status' => $donor ? true : false
            ], $donor ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {

            return new Response([
                'message' => $valditor->getMessageBag()->first(),
                'status' =>  false
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Donor $donor)
    {
        $this->authorize('view' ,  $donor);
        return new DonorResource($donor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $valditor = validator($request->all(), [

            'name' => ['required', 'string', 'min:2', 'max:45'],
            'phone' => ['required', 'digits:9', 'numeric'],
            'username' => ['required', 'string', Rule::unique('donors')->ignore($id)],
            'email' => ['required', 'string', 'email', Rule::unique('donors')->ignore($id)],
            'area_id' => ['required', 'int', 'exists:areas,id']

        ]);

        if (!$valditor->fails()) {
            $donor = Donor::findorfail($id);
            $this->authorize('update' ,  $donor);
            $donor->name = $request->input('name');
            $donor->phone = $request->input('phone');
            $donor->username = $request->input('username');
            $donor->email = $request->input('email');
            $donor->area_id = $request->input('area_id');
            $donor->save();

            return new Response([
                'object' => $donor,
                'message' => $donor ? 'Updated successfuly' : 'Error in the modification process',
                'status' => $donor ? true : false
            ], $donor ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {

            return new Response([
                'message' => $valditor->getMessageBag()->first(),
                'status' =>  false
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function Archives()
    {
        $this->authorize('restore' ,  Donor::class);
        $donor = Donor::onlyTrashed()->get();
        $data = DonorResource::collection($donor);
        return response()->json(['status' => true, 'message' => 'success', 'data' => $data], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $donor = Donor::findorfail($id);
        $this->authorize('delete' ,  $donor);
        $donor->delete();

        if ($donor) {
            return new Response([

                'object' =>  $donor,
                'message' => 'deleted successfuly',
                'status' => true

            ], Response::HTTP_OK);
        } else {

            return new Response([

                'message' => 'error in deleteion',
                'status' => false

            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Request $request, $id): Response
    {
        //
        $donor = Donor::onlyTrashed()->findOrFail($id);
        $this->authorize('restore' ,  $donor);
        $restored = $donor->restore();
        return new Response(['status' => $restored]);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Request $request, $id): Response
    {
        //
        $donor = Donor::withTrashed()->findOrFail($id);
        $this->authorize('forceDelete' ,  $donor);
        $deleted = $donor->forceDelete();
        return new Response(['status' => $deleted]);
    }

    public function campaigns(Request $request, $id)
    {
        $campaigns = Donor::findOrFail($id)->campaigns;
        return new Response(["status" => true, "data" => $campaigns], Response::HTTP_OK);
    }

    public function contactRequests(Request $request, $id)
    {
        $contactRequests = Donor::findOrFail($id)->contactRequests;
        return new Response(["status" => true, "data" => $contactRequests], Response::HTTP_OK);

    }
}
