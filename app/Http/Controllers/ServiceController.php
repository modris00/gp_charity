<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\ServiceResourceCollection;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eloquent
        $services = Service::all();
        // $services = Service::with('subcategory')->get();
        return new ServiceResourceCollection($services);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate
        $valid = Validator($request->all(), [
            'name' => 'required|string|min:2|max:45|unique:services,id',
            'description' => 'nullable|string|max:2000',
            'active' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,png|max:1024',
            'sub_category_id' => 'required|numeric|exists:sub_categories,id',
        ]);

        // store
        if (!$valid->fails()) {
            // Eloquent
            $services = new Service();
            $services->name = $request->input('name');
            $services->description = $request->input('description');
            $services->active = $request->input('active');
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = time() . $services->name . $image->getClientOriginalName();
                $request->file('image')->storePubliclyAs('services_images', $image_name, ['disk' => 'public']);
                $services->image = $image_name;
            }
            $services->sub_category_id = $request->input('sub_category_id');
            $saved = $services->save();
            return new Response(
                ['data' => $services, 'message' => $saved ? 'Created Services Successfully' : 'Created Services Failed!'],
                $saved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return new Response(['message' => $valid->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
        return new ServiceResource($service);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate
        $valid = Validator($request->all(), [
            'name' => 'required|string|min:2|max:45',
            'description' => 'nullable|string|max:2000',
            'active' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpg,png|max:1024',
            'sub_category_id' => 'required|numeric|exists:sub_categories,id',
        ]);

        // update
        if (!$valid->fails()) {
            // Eloquent
            $services = Service::findOrFail($id);
            $services->name = $request->input('name');
            $services->description = $request->input('description');
            $services->active = $request->input('active');
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = time() . $services->name . $image->getClientOriginalName();
                $request->file('image')->storePubliclyAs('services_images', $image_name, ['disk' => 'public']);
                $services->image = $image_name;
            }
            $services->sub_category_id = $request->input('sub_category_id');
            $update = $services->save();
            return new Response(
                ['data' => $services, 'message' => $update ? 'Update Services Successfully' : 'Update Services Failed!'],
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
        $services = Service::findOrFail($id);
        $deleted = $services->delete();
        return new Response(
            [
                "message" => $deleted ? "Successfully deleted" : "Failed deleted!"
            ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Request $request, $id): Response
    {
        //
        $service = Service::onlyTrashed()->findOrFail($id);
        $restored = $service->restore();
        return new Response(['status' => $restored]);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Request $request, $id): Response
    {
        //
        $service = Service::withTrashed()->findOrFail($id);
        $deleted = $service->forceDelete();
        return new Response(['status' => $deleted]);
    }
}
