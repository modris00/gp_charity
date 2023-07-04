<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Http\Resources\SupplierResource;
use App\Http\Resources\SupplierResourceCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SupplierController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Supplier::class, 'supplier');
    // }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorize('viewAny', Supplier::class);

        $suppliers = Supplier::all();
        $data = SupplierResource::collection($suppliers);
        return response()->json(['status' => true, 'message' => 'success', 'data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->authorize('create', Supplier::class);

        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:45',
            'phone' => 'required|numeric|digits:12',
            'address' => 'required|string|max:100'
        ]);

        if (!$validator->fails()) {
            $supplier = Supplier::create($request->all());
            return response()->json(['status' => !is_null($supplier), "message" => "Created Successfully", 'object' => $supplier]);

            // $supplier = new Supplier();
            // $supplier->name = $request->input("name");
            // $supplier->phone = $request->input("phone");
            // $supplier->address = $request->input("address");
            // $saved = $supplier->save();
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        // $this->authorize('view', $supplier);

        // return response()->json(['object' => $supplier]);
        return new SupplierResource($supplier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        // $this->authorize('update', $supplier);

        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3|max:45',
            'phone' => 'required|numeric|digits:12',
            'address' => 'required|string|max:100'
        ]);

        if (!$validator->fails()) {
            //Update
            $supplier->name = $request->input("name");
            $supplier->phone = $request->input("phone");
            $supplier->address = $request->input("address");
            $updated = $supplier->save();
            return response()->json(['status' => $updated, 'message' => $updated ? 'Updated successfully' : 'Update failed', 'object' => $supplier], $updated ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(['status' => false, 'message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        // $this->authorize('delete', $supplier);

        $deleted = $supplier->delete();
        return response()->json(['status' => $deleted, 'message' => $deleted ? 'Successfully deleted' : 'Delete failed'], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Request $request, $id): Response
    {
        $supplier = Supplier::onlyTrashed()->findOrFail($id);

        // $this->authorize('restore', $supplier);

        $restored = $supplier->restore();
        return new Response(['status' => $restored]);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Request $request, $id): Response
    {
        $supplier = Supplier::withTrashed()->findOrFail($id);

        // $this->authorize('forceDelete', $supplier);

        $deleted = $supplier->forceDelete();
        return new Response(['status' => $deleted]);
    }
}
