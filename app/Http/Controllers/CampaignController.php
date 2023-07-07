<?php

namespace App\Http\Controllers;

use App\Http\Resources\CampaignResource;
use App\Http\Resources\CampaignResourceCollection;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CampaignController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eloquent
        // $this->authorize('viewAny' , Campaign::class);
        // $campaign = Campaign::all();
        $campaign = Campaign::with('admin', 'currency')->get();
        // return new Response(['data' => $campaign]);
        return new CampaignResourceCollection($campaign);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->authorize('create' , Campaign::class);
        // validate
        $valid = Validator($request->all(), [
            'title' => 'required|string|max:190',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:Finished,Not Finished',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'admin_id' => 'required|exists:admins,id',
            'currency_id' => 'required|exists:currencies,id',
        ]);

        // store
        if (!$valid->fails()) {
            // Eloquent
            $campaign = new Campaign();
            $campaign->title = $request->input('title');
            $campaign->amount = $request->input('amount');
            $campaign->status = $request->input('status');
            $campaign->start_date = $request->input('start_date');
            $campaign->end_date = $request->input('end_date');
            // $campaign->admin_id = $request->input('admin_id');
            $campaign->admin_id = 1;
            $campaign->currency_id = $request->input('currency_id');
            $saved = $campaign->save();
            return new Response(
                ['data' => $campaign, 'message' => $saved ? 'Created Campaign Successfully' : 'Created Campaign Failed!'],
                $saved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return new Response(['message' => $valid->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     //
    //     $campaign = Campaign::with('admin', 'currency')->find($id);
    //     return new CampaignResource($campaign);
    // }

    public function show(Campaign $campaign)
    {
        // $this->authorize('view' , $campaign);
        return new CampaignResource($campaign);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate
        $valid = Validator($request->all(), [
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:Finished,Not Finished',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'admin_id' => 'required|exists:admins,id',
            'currency_id' => 'required|exists:currencies,id',
        ]);

        // store
        if (!$valid->fails()) {
            // Eloquent
            $campaign = Campaign::findOrFail($id);
            // $this->authorize('update' , $campaign);
            $campaign->title = $request->input('title');
            $campaign->amount = $request->input('amount');
            $campaign->status = $request->input('status');
            $campaign->start_date = $request->input('start_date');
            $campaign->end_date = $request->input('end_date');
            $campaign->admin_id = 1;
            $campaign->currency_id = $request->input('currency_id');
            $update = $campaign->save();
            return new Response(
                ['data' => $campaign, 'message' => $update ? 'Update Campaign Successfully' : 'Update Campaign Failed!'],
                $update ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return new Response(['message' => $valid->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Eloquent
        $campaign = Campaign::findOrFail($id);
        // $this->authorize('delete' , $campaign);
        $deleted = $campaign->delete();
        return new Response(
            [
                "message" => $deleted ? "Successfully deleted" : "Failed deleted!"
            ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }

    public function Archives()
    {
        // $this->authorize('restore', $supplier);
        $campaign = Campaign::onlyTrashed()->get();
        $data = CampaignResource::collection($campaign);
        return response()->json(['status' => true, 'message' => 'success', 'data' => $data], 200);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Request $request, $id): Response
    {
        //
        $campaign = Campaign::onlyTrashed()->findOrFail($id);
        // $this->authorize('restore' , $campaign);
        $restored = $campaign->restore();
        return new Response(['status' => $restored]);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Request $request, $id): Response
    {
        //
        $campaign = Campaign::withTrashed()->findOrFail($id);
        // $this->authorize('forceDelete' , $campaign);
        $deleted = $campaign->forceDelete();
        return new Response(['status' => $deleted]);
    }
}
