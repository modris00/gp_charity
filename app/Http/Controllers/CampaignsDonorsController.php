<?php

namespace App\Http\Controllers;

use App\Http\Resources\CampaignsDonorsResource;
use App\Http\Resources\CampaignsDonorsResourceCollection;
use App\Models\CampaignsDonors;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CampaignsDonorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eloquent
        // $this->authorize('viewAny' , CampaignsDonors::class);
        $campaignsDonors = CampaignsDonors::all();
        return new CampaignsDonorsResourceCollection($campaignsDonors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->authorize('create' , CampaignsDonors::class);
        // validate
        $valid = Validator($request->all(), [
            'amount' => 'required|numeric|min:0',
            'donor_id' => 'required|int|exists:donors,id',
            'campaign_id' => 'required|int|exists:campaigns,id',
        ]);

        // store
        if (!$valid->fails()) {
            // Eloquent
            $campaignsDonors = new CampaignsDonors();
            $campaignsDonors->amount = $request->input('amount');
            $campaignsDonors->donor_id = $request->input('donor_id');
            $campaignsDonors->campaign_id = $request->input('campaign_id');
            $saved = $campaignsDonors->save();

            return new Response(
                ['data' => $campaignsDonors, 'message' => $saved ? 'Created Campaign Donors Successfully' : 'Created Campaign Donors Failed!'],
                $saved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return new Response(['message' => $valid->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CampaignsDonors $campaignsDonor)
    {
        // $this->authorize('view' , $campaignsDonor);
        return new CampaignsDonorsResource($campaignsDonor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate
        $valid = Validator($request->all(), [
            'amount' => 'required|numeric|min:0',
            'donor_id' => 'required|int|exists:donors,id',
            'campaign_id' => 'required|int|exists:campaigns,id',
        ]);

        // store
        if (!$valid->fails()) {
            // Eloquent
            $campaignsDonors = CampaignsDonors::findOrFail($id);
            // $this->authorize('update' , $campaignsDonors);
            $campaignsDonors->amount = $request->input('amount');
            $campaignsDonors->donor_id = $request->input('donor_id');
            $campaignsDonors->campaign_id = $request->input('campaign_id');
            $update = $campaignsDonors->save();

            return new Response(
                ['data' => $campaignsDonors, 'message' => $update ? 'Update Campaign Donors Successfully' : 'Update Campaign Donors Failed!'],
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
        $campaignsDonors = CampaignsDonors::findOrFail($id);
        // $this->authorize('delete' , $campaignsDonors);
        $deleted = $campaignsDonors->delete();
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
        $CampaignsDonors = CampaignsDonors::onlyTrashed()->get();
        $data = CampaignsDonorsResource::collection($CampaignsDonors);
        return response()->json(['status' => true, 'message' => 'success', 'data' => $data], 200);
    }



    public function restore(Request $request, $id)
    {
        //
        $object = CampaignsDonors::onlyTrashed()->findOrFail($id);
        // $this->authorize('restore' , $object);
        $restored = $object->restore();
        return new Response(['status' => $restored]);
    }

    public function forceDelete(Request $request, $id)
    {
        //
        $object = CampaignsDonors::withTrashed()->findOrFail($id);
        // $this->authorize('forceDelete' , $object);
        $deleted = $object->forceDelete();
        // if ($deleted && $object->image) {
        //     // Storage::delete($object->image);
        //     Storage::disk("public")->delete($object->image);
        //     // dd($object->image);
        // }
        return response()->json(['status' => $deleted]);
    }
}
