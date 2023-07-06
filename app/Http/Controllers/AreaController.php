<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\AreaResource;
use App\Http\Resources\AreaResourceCollection;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // $this->authorize('viewAny' , Area::class);
        $area = Area::latest()->paginate(10);
        return new AreaResourceCollection($area);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

         // $this->authorize('create' , Area::class);
        $validator = validator($request->all(), [
            'name' => ['required', 'string', 'min:2', 'max:30'],
            'city_id' => ['required', 'int', 'numeric', 'exists:cities,id']
        ]);

        if (!$validator->fails()) {

            $area  = new Area();
            $area->name = $request->input('name');
            $area->city_id = $request->input('city_id');
            $area->save();

            return new Response([
                'date' => $area,
                'message' => $area ?  'Created successfuly' : 'error adding',
                'status' => $area ? true : false
            ], $area ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {

            return new Response([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        // $this->authorize('view' , $area);
        return new AreaResource($area);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validator = validator($request->all(), [
            'name' => ['required', 'string', 'min:2', 'max:30'],
            'city_id' => ['required', 'int', 'numeric', 'exists:cities,id']
        ]);

        if (!$validator->fails()) {

            $area = Area::findorfail($id);
            // $this->authorize('update' ,  $area);
            $area->name = $request->input('name');
            $area->city_id = $request->input('city_id');
            $area->save();

            return new Response([
                'date' => $area,
                'message' => $area ?  'Updated successfuly' : 'Error in the modification process',
                'status' => $area ? true : false
            ], $area ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {

            return new Response([

                'message' => $validator->getMessageBag()->first(),
                'status' => Response::HTTP_BAD_REQUEST

            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $area = Area::findorfail($id);
        // $this->authorize('delete' ,  $area);
        $area->delete();

        if ($area) {
            return new Response([

                'object' => $area,
                'message' => 'deleted successfuly',
                'status' => true

            ], Response::HTTP_OK);
        } else {

            return new Response([

                'message' => 'error in deleteion',
                'status' => false

            ], Response::HTTP_BAD_REQUEST);
        }
    }


    public function Archives()
    {
        // $this->authorize('restore' , Area::class);
        $area = Area::onlyTrashed()->get();
        $data = AreaResource::collection($area);
        return response()->json(['status' => true, 'message' => 'success', 'data' => $data] , 200);
    }


    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Request $request, $id): Response
    {
        
        $area = Area::onlyTrashed()->findOrFail($id);
        // $this->authorize('restore' ,  $area);
        $restored = $area->restore();
        return new Response(['status' => $restored]);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Request $request, $id): Response
    {
        //
        $area = Area::withTrashed()->findOrFail($id);
        // $this->authorize('forceDelete' ,  $area);
        $deleted = $area->forceDelete();
        return new Response(['status' => $deleted]);
    }
}
