<?php

namespace App\Http\Controllers;

use App\Http\Resources\CampaignsServicesResource;
use App\Http\Resources\CampaignsServicesResourceCollection;
use App\Models\CampaignsServices;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CampaignsServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eloquent
        // $this->authorize('viewAny' , CampaignsServices::class);
        $campaignsServices = CampaignsServices::paginate(10);
        return new CampaignsServicesResourceCollection($campaignsServices);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->authorize('create' , CampaignsServices::class);
        // validate
        $valid = Validator($request->all(), [
            'amount' => 'required|numeric|min:0',
            'description' => 'required|max:200',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|boolean',
            'service_id' => 'required|exists:services,id',
            'campaign_id' => 'required|exists:campaigns,id',
            // 'start_date' => 'required|date|after_or_equal:today',
            // 'end_date' => 'required|date|after:start_date',
        ]);

        // store
        if (!$valid->fails()) {
            // Eloquent
            $campaignsServices = new CampaignsServices();
            $campaignsServices->amount = $request->input('amount');
            $campaignsServices->description = $request->input('description');
            $campaignsServices->start_date = $request->input('start_date');
            $campaignsServices->end_date = $request->input('end_date');
            $campaignsServices->status = $request->input('status');
            $campaignsServices->service_id = $request->input('service_id');
            $campaignsServices->campaign_id = $request->input('campaign_id');
            $saved = $campaignsServices->save();

            return new Response(
                ['data' => $campaignsServices, 'message' => $saved ? 'Created Campaign Services Successfully' : 'Created Campaign Services Failed!'],
                $saved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return new Response(['message' => $valid->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CampaignsServices $campaignsService)
    {
        // $this->authorize('view' , $campaignsService);
        return new CampaignsServicesResource($campaignsService);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate
        $valid = Validator($request->all(), [
            'amount' => 'required|numeric|min:0',
            'description' => 'required|max:200',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|boolean',
            'service_id' => 'required|exists:services,id',
            'campaign_id' => 'required|exists:campaigns,id',
            // 'start_date' => 'required|date|after_or_equal:today',
            // 'end_date' => 'required|date|after:start_date',
        ]);

        // store
        if (!$valid->fails()) {
            // Eloquent
            $campaignsServices = CampaignsServices::findOrFail($id);
            // $this->authorize('update' , $campaignsServices);
            $campaignsServices->amount = $request->input('amount');
            $campaignsServices->description = $request->input('description');
            $campaignsServices->start_date = $request->input('start_date');
            $campaignsServices->end_date = $request->input('end_date');
            $campaignsServices->status = $request->input('status');
            $campaignsServices->service_id = $request->input('service_id');
            $campaignsServices->campaign_id = $request->input('campaign_id');
            $update = $campaignsServices->save();
            return new Response(
                ['data' => $campaignsServices, 'message' => $update ? 'Update Campaign Services Successfully' : 'Update Campaign Services Failed!'],
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
        $campaignsServices = CampaignsServices::findOrFail($id);
        // $this->authorize('delete' , $campaignsServices);
        $deleted = $campaignsServices->delete();
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
        $object = CampaignsServices::onlyTrashed()->findOrFail($id);
        // $this->authorize('restore' , $object);
        $restored = $object->restore();
        return response()->json(['status' => $restored]);
    }

    public function forceDelete(Request $request, $id)
    {
        //
        $object = CampaignsServices::withTrashed()->findOrFail($id);
        // $this->authorize('forceDelete' , $object);
        $deleted = $object->forceDelete();
        // if ($deleted && $object->image) {
        //     // Storage::delete($object->image);
        //     Storage::disk("public")->delete($object->image);
        //     // dd($object->image);
        // }
        return response()->json(['status' => $deleted]);
    }

    public function Archives()
    {
        // $this->authorize('restore', $supplier);
        $cs = CampaignsServices::onlyTrashed()->get();
        $data = CampaignsServicesResource::collection($cs);
        return response()->json(['status' => true, 'message' => 'success', 'data' => $data], 200);
    }
}
