<?php

namespace App\Http\Controllers;

use App\Http\Resources\CampaignImagesResource;
use App\Http\Resources\CampaignImagesResourceCollection;
use App\Models\CampaignImages;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class CampaignImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eloquent
        // $campaignImages = CampaignImages::all();
        $campaignImages = CampaignImages::with('campaign')->paginate(10);
        return new CampaignImagesResourceCollection($campaignImages);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate
        $valid = Validator($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'description' => 'required|max:300',
            'active' => 'required|boolean',
            'campaign_id' => 'required|exists:campaigns,id',
        ]);

        // store
        if (!$valid->fails()) {
            // Eloquent
            $campaignImages = new CampaignImages();
            $campaignImages->description = $request->input('description');
            $campaignImages->active = $request->input('active');
            $campaignImages->campaign_id = $request->input('campaign_id');
            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $images) {
                    $ImageName = time() . '_' . $campaignImages->image . '.' . $images->getClientOriginalExtension();
                    $images->storePubliclyAs('campaignImages', $ImageName, ['disk' => 'public']);
                    $campaignImages->image =  $ImageName;
                }
            }
            $saved = $campaignImages->save();
            return new Response(
                ['data' => $campaignImages, 'message' => $saved ? 'Created Campaign Images Successfully' : 'Created Campaign Images Failed!'],
                $saved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return new Response(['message' => $valid->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CampaignImages $campaignImage)
    {
        //
        return new CampaignImagesResource($campaignImage);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate
        $valid = Validator($request->all(), [
            'image' => 'nullable|image|mimes:jpg,png,jpeg',
            'description' => 'required|max:300',
            'active' => 'required|boolean',
            'campaign_id' => 'required|exists:campaigns,id',
        ]);

        // update
        if (!$valid->fails()) {
            // Eloquent
            $campaignImages = CampaignImages::fidOrFail($id);
            $campaignImages->description = $request->input('description');
            $campaignImages->active = $request->input('active');
            $campaignImages->campaign_id = $request->input('campaign_id');
            // if ($request->hasFile('image')) {
            //     foreach ($request->file('image') as $images) {
            //         $ImageName = time() . '_' . $campaignImages->image . '.' . $images->getClientOriginalExtension();
            //         $images->storePubliclyAs('campaignImages', $ImageName, ['disk' => 'public']);
            //         $campaignImages->image =  $ImageName;
            //     }
            // }
            $update = $campaignImages->save();
            return new Response(
                ['data' => $campaignImages, 'message' => $update ? 'Update Campaign Images Successfully' : 'Update Campaign Images Failed!'],
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
        $campaignImages = CampaignImages::findOrFail($id);
        $deleted = $campaignImages->delete();
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
        $object = CampaignImages::onlyTrashed()->findOrFail($id);
        $restored = $object->restore();
        return response()->json(['status' => $restored]);
    }

    public function forceDelete(Request $request, $id)
    {
        //
        $object = CampaignImages::withTrashed()->findOrFail($id);
        $deleted = $object->forceDelete();
        if ($deleted && $object->image) {
            // Storage::delete($object->image);
            Storage::disk("public")->delete($object->image);
            // dd($object->image);
        }
        return response()->json(['status' => $deleted]);
    }

    public function Archives()
    {
        // $this->authorize('restore', $supplier);
        $camp_imgs = CampaignImages::onlyTrashed()->get();
        $data = CampaignImagesResource::collection($camp_imgs);
        return response()->json(['status' => true, 'message' => 'success', 'data' => $data], 200);
    }
}
