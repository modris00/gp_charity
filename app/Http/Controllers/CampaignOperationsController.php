<?php

namespace App\Http\Controllers;

use App\Http\Resources\CampaignOperationsResource;
use App\Http\Resources\CampaignOperationsResourceCollection;
use App\Models\CampaignOperations;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CampaignOperationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = CampaignOperations::simplePaginate(10); //simplePaginate
        // return ResourceCollection
        return new CampaignOperationsResourceCollection($data);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = validator($request->all(), [
            "date" => "required|date",
            "description" => "required|string|max:255|min:5",
            "cost" => "required|numeric",
            "cost_type" => "required|in:Primary,Additional",
            "admin_id" => "required|int|numeric|exists:admins,id",
            "campaign_id" => "required|int|numeric|exists:campaigns,id",
            "service_id" => "required|int|numeric|exists:services,id",
        ]);
        // validateion
        if (!$validator->fails()) {
            $data = new CampaignOperations();
            $data->date = $request->input("date");
            $data->description = $request->input("description");
            $data->cost = $request->input("cost");
            $data->cost_type = $request->input("cost_type");
            $data->admin_id = $request->input("admin_id");
            $data->campaign_id = $request->input("campaign_id");
            $data->service_id = $request->input("service_id");
            $saved = $data->save();
            return new Response(
                ["object" => $data, "message" => $saved ? "create CampaignOperations is successfully" : "create CampaignOperations is failed"],
                $saved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return new Response(["status" => false, "message" => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CampaignOperations $campaignOperation)
    {
        //Resource
        return new CampaignOperationsResource($campaignOperation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CampaignOperations $CampaignOperation)
    {
        //validateion
        $validator = validator($request->all(), [
            "date" => "required|date",
            "description" => "required|string|max:255|min:5",
            "cost" => "required|numeric",
            "cost_type" => "required|in:Primary,Additional",
            "admin_id" => "required|int|numeric|exists:admins,id",
            "campaign_id" => "required|int|numeric|exists:campaigns,id",
            "service_id" => "required|int|numeric|exists:services,id",
        ]);
        // saved data
        if (!$validator->fails()) {
            $CampaignOperation->date = $request->input("date");
            $CampaignOperation->description = $request->input("description");
            $CampaignOperation->cost = $request->input("cost");
            $CampaignOperation->cost_type = $request->input("cost_type");
            $CampaignOperation->admin_id = $request->input("admin_id");
            $CampaignOperation->campaign_id = $request->input("campaign_id");
            $CampaignOperation->service_id = $request->input("service_id");
            $saved = $CampaignOperation->save();
            return new Response(
                ["object" => $CampaignOperation, "message" => $saved ? "create CampaignOperations is successfully" : "create CampaignOperations is failed"],
                $saved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return new Response(["status" => false, "message" => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CampaignOperations $CampaignOperation)
    {
        // delete
        $deleted = $CampaignOperation->delete();
        return new Response(["status" => $deleted, "message" => "deleted is successfully"], Response::HTTP_OK);
    }


    public function Archives()
    {
        // $this->authorize('restore', $supplier);
        $donor = CampaignOperations::onlyTrashed()->get();
        $data = CampaignOperationsResource::collection($donor);
        return response()->json(['status' => true, 'message' => 'success', 'data' => $data], 200);
    }


    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Request $request, $id)
    {
        $campaign_operation = CampaignOperations::onlyTrashed()->findOrFail($id);
        $restored = $campaign_operation->restore();
        return new Response(["status" => $restored]);

        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Request $request, $id)
    {
        //
        $campaign_operation = CampaignOperations::withTrashed()->findOrFail($id);
        $forceDelete = $campaign_operation->forceDelete();
        return new Response(["status" => $forceDelete]);
    }
}
