<?php

namespace App\Http\Controllers;

use App\Http\Resources\BillResource;
use App\Http\Resources\BillResourceCollection;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class BillController extends Controller
{

    // public function __construct()
    // {
    //     $this->authorizeResource(Bill::class, 'bill');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorize('viewAny', Bill::class);

        $bills = Bill::all();
        $data = BillResource::collection($bills);
        return response()->json(['status' => true, 'message' => 'success', 'data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->authorize('create', Bill::class);

        $validator = Validator($request->all(), [
            "cost" => "required|numeric",
            "description" => "required|max:150",
            "image" => 'nullable|image|mimes:jpeg,png,jpg,gif',
            "campaign_id" => "required|numeric|exists:campaigns,id",
            "supplier_id" => "required|numeric|exists:suppliers,id",
            "currency_id" => "required|numeric|exists:currencies,id",
            "campaign_service_id" => "required|numeric|exists:campaigns_services,id",

        ]);

        if (!$validator->fails()) {
            // Eloquent
            $bill = new Bill();
            $bill->cost = $request->input('cost');
            $bill->description = $request->input('description');

            $bill->campaign_id = $request->input('campaign_id');
            $bill->supplier_id = $request->input('supplier_id');
            $bill->currency_id = $request->input('currency_id');
            $bill->campaign_service_id = $request->input('campaign_service_id');

            if ($request->hasFile('image')) {
                $billImage = $request->file('image');
                $imageName = time() . '_image_' . $bill->id . '.' . $billImage->getClientOriginalExtension();
                $billImage->storePubliclyAs('bills', $imageName, ['disk' => 'public']);
                $bill->image = 'bills/' . $imageName;
            }
            $saved = $bill->save();
            return response()->json(
                [
                    'data' => $bill,
                    'message' => $saved ? 'Successfully Created' : 'Failed To Create!'
                ],
                $saved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Bill $bill)
    {
        // $this->authorize('view', $bill);

        // Return Resource Object
        return new BillResource($bill);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        // $this->authorize('update', $bill);

        $validator = Validator($request->all(), [
            "cost" => "required|numeric",
            "description" => "required|max:150",
            "image" => 'nullable|image|mimes:jpeg,png,jpg,gif',
            "campaign_id" => "required|numeric|exists:campaigns,id",
            "supplier_id" => "required|numeric|exists:suppliers,id",
            "currency_id" => "required|numeric|exists:currencies,id",
            "campaign_service_id" => "required|numeric|exists:campaigns_services,id",

        ]);

        if (!$validator->fails()) {
            $bill->cost = $request->input('cost');
            $bill->description = $request->input('description');

            $bill->campaign_id = $request->input('campaign_id');
            $bill->supplier_id = $request->input('supplier_id');
            $bill->currency_id = $request->input('currency_id');
            $bill->campaign_service_id = $request->input('campaign_service_id');

            $oldImagePath = $bill->image;
            $newImagePath = $this->uploadFile($request, $bill);

            if ($newImagePath) {
                $bill->image = $newImagePath;
            }

            if ($newImagePath && $oldImagePath) {
                Storage::disk("public")->delete($oldImagePath);
            }

            $updated = $bill->save();

            return response()->json(
                [
                    'status' => $updated,
                    'message' => $updated ? 'Successfully Updated' : 'Failed To Update!'
                ],
                $updated ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    protected function uploadFile(Request $request, $bill)
    {
        if ($request->hasFile('image')) {
            $billImage = $request->file('image');
            $imageName = time() . '_image_' . $bill->id . '.' . $billImage->getClientOriginalExtension();
            $path = $billImage->storePubliclyAs('bills', $imageName, ['disk' => 'public']);
            // $bill->image = 'bills/' . $imageName;
            return $path;
        } else {
            return;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        // $bill = Bill::findOrFail($id);
        // $this->authorize('delete', $bill);

        //
        $deleted = $bill->delete();
        return response()->json([
            'status' => $deleted,
            'message' => $deleted ? 'Deleted successfully' : 'Delete failed'
        ], $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    public function restore(Request $request, $id)
    {
        // $this->authorize('restore', $bill);

        //
        $bill = Bill::onlyTrashed()->findOrFail($id);
        $restored = $bill->restore();
        return response()->json(['status' => $restored]);
    }

    public function forceDelete(Request $request, $id)
    {
        // $this->authorize('forceDelete', $bill);

        //
        $bill = Bill::withTrashed()->findOrFail($id);
        $deleted = $bill->forceDelete();
        if ($deleted && $bill->image) {
            Storage::disk("public")->delete($bill->image);
        }
        return response()->json(['status' => $deleted]);
    }
    public function Archives()
    {
        $Bills = Bill::onlyTrashed()->get();
        $data = BillResource::collection($Bills);
        return response()->json(['status' => true, 'message' => 'success', 'data' => $data], 200);
    }
}
