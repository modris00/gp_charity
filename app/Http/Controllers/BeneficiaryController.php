<?php

namespace App\Http\Controllers;

use App\Http\Resources\BeneficiaryResource;
use App\Http\Resources\BeneficiaryResourceCollection;
use App\Models\Beneficiary;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Spatie\Permission\Models\Role;

class BeneficiaryController extends Controller
{

    // public function __construct()
    // {
    //     $this->authorizeResource(Beneficiary::class, 'beneficiary');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Beneficiary::class);

        // $beneficiaries = Beneficiary::latest()->Paginate(10);
        $beneficiaries = Beneficiary::all();
        $data =  BeneficiaryResource::collection($beneficiaries);
        return response()->json(['status' => true, 'message' => 'success', 'data' => $data]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Beneficiary::class);
        $validator = validator($request->all(), [
            'name' => ['required', 'string', 'min:2', 'max:45'],
            'username' => ['required', 'string', 'unique:beneficiaries,username'],
            'phone' => ['required', 'digits:9', 'numeric'],
            'email' => ['required', 'string', 'email', 'unique:beneficiaries,email'],
            'password' => ['nullable', RulesPassword::min(8)->symbols()->letters()->uncompromised()],
            'age' => ['nullable', 'numeric', ''],
            'gender' => ['required', 'string', 'in:Male,Female'],
            'area_id' => ['required', 'int', 'exists:areas,id']
        ]);

        if (!$validator->fails()) {

            $beneficiary = new Beneficiary();
            $beneficiary->name = $request->input('name');
            $beneficiary->phone = $request->input('phone');
            $beneficiary->username = $request->input('username');
            $beneficiary->email = $request->input('email');
            $beneficiary->password = Hash::make($request->input('password'));
            $beneficiary->age = $request->input('age');
            $beneficiary->gender = $request->input('gender');
            $beneficiary->area_id = $request->input('area_id');
            $saved = $beneficiary->save();
            if ($saved) {
                $role = Role::findById(2, 'beneficiary'); //User-Beneficiary
                $beneficiary->assignRole($role);
            }
            // if ($saved) {
            //   //$beneficiary->syncRoles(Role::findById($request->input('role_id'), 'beneficiary'));
            //     $beneficiary->syncRoles(Role::findById(2, 'beneficiary'));
            // }
            return new Response([
                'object' => $beneficiary,
                'message' => $beneficiary ? 'Created successfuly' : 'error adding',
                'status' => $beneficiary ? true : false
            ], $beneficiary ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {

            return new Response([
                'message' => $validator->getMessageBag()->first(),
                'status' =>  false
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Beneficiary $beneficiary)
    {
        $this->authorize('view', $beneficiary);
        return new BeneficiaryResource($beneficiary);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  Beneficiary $beneficiary)
    {
        $this->authorize('update', $beneficiary);
        $validator = validator($request->all(), [
            'name' => ['required', 'string', 'min:2', 'max:45'],
            'phone' => ['required', 'digits:9', 'numeric'],
            'username' => ['required', 'string', Rule::unique('beneficiaries')->ignore($beneficiary->id)],
            'email' => ['required', 'string', 'email', Rule::unique('beneficiaries')->ignore($beneficiary->id)],
            'age' => ['nullable', 'numeric'],
            'gender' => ['required', 'string', 'in:Male,Female'],
            'area_id' => ['required', 'int', 'exists:areas,id']
        ]);

        if (!$validator->fails()) {
            // $beneficiary = Beneficiary::findorfail($id);
            $beneficiary->name = $request->input('name');
            $beneficiary->phone = $request->input('phone');
            $beneficiary->username = $request->input('username');
            $beneficiary->email = $request->input('email');
            $beneficiary->age = $request->input('age');
            $beneficiary->gender = $request->input('gender');
            $beneficiary->area_id = $request->input('area_id');
            $beneficiary->save();

            return new Response([
                'object' => $beneficiary,
                'message' => $beneficiary ? 'Updated successfuly' : 'Error in the modification process',
                'status' => $beneficiary ? true : false
            ], $beneficiary ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {

            return new Response([
                'message' => $validator->getMessageBag()->first(),
                'status' =>  false
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Beneficiary $beneficiary)
    {
        $this->authorize('delete', $beneficiary);

        // $beneficiary = Beneficiary::findorfail($id);
        $beneficiary->delete();

        if ($beneficiary) {
            return new Response([

                'object' =>  $beneficiary,
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

    public function Archives()
    {
       // $this->authorize('restore', $supplier);
        $beneficiary = Beneficiary::onlyTrashed()->get();
        $data = BeneficiaryResource::collection($beneficiary);
        return response()->json(['status' => true, 'message' => 'success', 'data' => $data], 200);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Request $request, $id): Response
    {
        $beneficiary = Beneficiary::onlyTrashed()->findOrFail($id);

         $this->authorize('restore', $beneficiary);

        $restored = $beneficiary->restore();
        return new Response(['status' => $restored]);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Request $request, $id): Response
    {
        $beneficiary = Beneficiary::withTrashed()->findOrFail($id);

        $this->authorize('forceDelete', $beneficiary);

        $deleted = $beneficiary->forceDelete();
        return new Response(['status' => $deleted]);
    }

    public function campaigns(Request $request, $id)
    {
        $campaigns = Beneficiary::findOrFail($id)->campaigns;
        return new Response(["status" => true, "data" => $campaigns], Response::HTTP_OK);
    }

    public function contactRequests(Request $request, $id)
    {
        $contactRequests = Beneficiary::findOrFail($id)->contactRequests;
        return new Response(["status" => true, "data" => $contactRequests], Response::HTTP_OK);
    }
}
