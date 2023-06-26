<?php

namespace App\Http\Controllers;

use App\Http\Resources\CampaignsBeneficiariesResource;
use App\Http\Resources\CampaignsBeneficiariesResourceCollection;
use App\Models\CampaignsBeneficiaries;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CampaignsBeneficiariesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eloquent
        $campaignsBeneficiaries = CampaignsBeneficiaries::paginate(10);
        return new CampaignsBeneficiariesResourceCollection($campaignsBeneficiaries);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate
        $valid = Validator($request->all(), [
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|min:3',
            'status' => 'required|string|in:finished,not_finished',
            'beneficiary_id' => 'required|int|exists:beneficiaries,id',
            'campaign_id' => 'required|int|exists:campaigns,id',
        ]);

        // store
        if (!$valid->fails()) {
            // Eloquent
            $campaignsBeneficiaries = new CampaignsBeneficiaries();
            $campaignsBeneficiaries->amount = $request->input('amount');
            $campaignsBeneficiaries->description = $request->input('description');
            $campaignsBeneficiaries->status = $request->input('status');
            $campaignsBeneficiaries->beneficiary_id = $request->input('beneficiary_id');
            $campaignsBeneficiaries->campaign_id = $request->input('campaign_id');
            $saved = $campaignsBeneficiaries->save();

            return new Response(
                ['data' => $campaignsBeneficiaries, 'message' => $saved ? 'Created Campaign Beneficiaries Successfully' : 'Created Campaign Beneficiaries Failed!'],
                $saved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return new Response(['message' => $valid->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CampaignsBeneficiaries $CampaignsBeneficiary)
    {
        //
        return new CampaignsBeneficiariesResource($CampaignsBeneficiary);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate
        $valid = Validator($request->all(), [
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string|min:3',
            'status' => 'required|string|in:finished,not_finished',
            'beneficiary_id' => 'required|int|exists:beneficiaries,id',
            'campaign_id' => 'required|int|exists:campaigns,id',
        ]);

        // update
        if (!$valid->fails()) {
            // Eloquent
            $campaignsBeneficiaries = CampaignsBeneficiaries::findOrFail($id);
            $campaignsBeneficiaries->amount = $request->input('amount');
            $campaignsBeneficiaries->description = $request->input('description');
            $campaignsBeneficiaries->status = $request->input('status');
            $campaignsBeneficiaries->beneficiary_id = $request->input('beneficiary_id');
            $campaignsBeneficiaries->campaign_id = $request->input('campaign_id');
            $update = $campaignsBeneficiaries->save();

            return new Response(
                ['data' => $campaignsBeneficiaries, 'message' => $update ? 'Update Campaign Beneficiaries Successfully' : 'Update Campaign Beneficiaries Failed!'],
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
        $campaignsBeneficiaries = CampaignsBeneficiaries::findOrFail($id);
        $deleted = $campaignsBeneficiaries->delete();
        return new Response(
            [
                "message" => $deleted ? "Successfully deleted" : "Failed deleted!"
            ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
    public function restore(Request $request, $id)
    {
        //
        $object = CampaignsBeneficiaries::onlyTrashed()->findOrFail($id);
        $restored = $object->restore();
        return response()->json(['status' => $restored]);
    }

    public function forceDelete(Request $request, $id)
    {
        //
        $object = CampaignsBeneficiaries::withTrashed()->findOrFail($id);
        $deleted = $object->forceDelete();
        // if ($deleted && $object->image) {
        //     // Storage::delete($object->image);
        //     Storage::disk("public")->delete($object->image);
        //     // dd($object->image);
        // }
        return response()->json(['status' => $deleted]);
    }
}
