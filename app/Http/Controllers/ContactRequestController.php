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
            // $user = Donor::findOrFail(1);
            $user = $request->user();
            // $user = Auth::user();
            $user->contactRequests()->create($request->all());
            return response()->json(['status' => !is_null($user), 'object' => $user]);
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
    // public function update(Request $request, ContactRequest $contactRequest)
    // {
    //     $this->authorize('update', $contactRequest);
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactRequest $contactRequest)
    {
        $this->authorize('delete', $contactRequest);
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
}
