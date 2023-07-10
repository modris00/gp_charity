<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContactRequestResource;
use App\Models\Beneficiary;
use App\Models\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactRequestController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(ContactRequest::class, 'contactRequest');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', ContactRequest::class);

        $ContactRequests = ContactRequest::all();
        $data = ContactRequestResource::collection($ContactRequests);
        return response()->json(['status' => true, 'message' => 'success', 'data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', ContactRequest::class);

        $validator = Validator($request->all(), [
            'title' => 'required|string|min:3|max:100',
            'message' => 'required|string|max:250',
            'email' => 'required|string|email',
            'phone' => 'required|numeric|digits:10',
        ]);

        if (!$validator->fails()) {
            // $user = Beneficiary::findOrFail(1);
            $user = \App\Models\Donor::findOrFail(1);
            // $user = Auth::user();

            // $user = $request->user(); //this is the one
            $contactRequest = $user->contactRequests()->create($request->all());
            return response()->json(['status' => !is_null($user), 'data' => new ContactRequestResource($contactRequest)]);
        } else {
            return response()->json(
                [
                    'message' => $validator->getMessageBag()->first(),
                    'status' =>  false
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactRequest $contactRequest)
    {
        $this->authorize('view', $contactRequest);

        return new ContactRequestResource($contactRequest);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactRequest $contactRequest)
    {
        $this->authorize('update', $contactRequest);

        $validator = Validator($request->all(), [
            'response' => 'nullable|string|max:150',
            'isClosed' => 'required|boolean',
        ]);

        if (!$validator->fails()) {
            $contactRequest->response = $request->input("response");
            $contactRequest->isClosed = $request->input("isClosed");
            $updated = $contactRequest->save();
            return response()->json([
                'status' => $updated,
                'message' => $updated ? "Succesfully Updated" : "Failed to update",
                'data' => $contactRequest,
            ], Response::HTTP_OK);
        } else {
            return response()->json(
                [
                    'message' => $validator->getMessageBag()->first(),
                    'status' =>  false
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactRequest $contactRequest)
    {
        $this->authorize('delete', $contactRequest);
        $deleted = $contactRequest->delete();
        return response()->json([
            'status' => $deleted,
            'message' => $deleted ? 'Deleted successfully' : 'Delete failed'
        ], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    public function restore(Request $request, $id)
    {
        $contactRequest = ContactRequest::onlyTrashed()->findOrFail($id);
        $this->authorize('restore', $contactRequest);

        $restored = $contactRequest->restore();
        return response()->json(['status' => $restored]);
    }

    public function forceDelete(Request $request, $id)
    {
        $contactRequest = ContactRequest::withTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $contactRequest);

        $deleted = $contactRequest->forceDelete();
        return response()->json(['status' => $deleted]);
    }

    public function Archives()
    {
        // $this->authorize('restore', $supplier);
        $contactRequests = ContactRequest::onlyTrashed()->get();
        $data = ContactRequestResource::collection($contactRequests);
        return response()->json(['status' => true, 'message' => 'success', 'data' => $data], 200);
    }
}
