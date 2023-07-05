<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\CityResourceCollection;
use App\Models\area;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $city = City::latest()->paginate(10);
        return new CityResourceCollection($city);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = validator($request->all(), [
            'name' => ['required', 'string', 'min:2', 'max:30'],
            'country_id' => ['required', 'int', 'numeric', 'exists:countries,id']
        ]);

        if (!$validator->fails()) {

            $city  = new City();
            $city->name = $request->input('name');
            $city->country_id = $request->input('country_id');
            $city->save();

            return new Response([
                'date' => $city,
                'message' => $city ? 'Created successfuly' : 'error adding',
                'status' => $city ? true : false
            ], $city ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return new Response(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        // $city_city = city::with('areas')->findorfail($id);
        // return new Response([
        //     'date' => $city_city,
        //     'status' => true
        // ],  Response::HTTP_OK);
        return new CityResource($city);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validator = validator($request->all(), [
            'name' => ['required', 'string', 'min:2', 'max:30'],
            'country_id' => ['required', 'int', 'numeric', 'exists:countries,id']
        ]);

        if (!$validator->fails()) {

            $city = City::findorfail($id);
            $city->name = $request->input('name');
            $city->country_id = $request->input('country_id');
            $city->save();

            return new Response([
                'date' => $city,
                'message' => $city ?  'Updated successfuly' : 'Error in the modification process',
                'status' => $city ? true : false
            ], $city ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
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
        $city = City::findorfail($id);
        $city->delete();

        if ($city) {
            return new Response([

                'object' => $city,
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
        // $this->authorize('restore', $supplier);
        $city = City::onlyTrashed()->get();
        $data = CityResource::collection($city);
        return response()->json(['status' => true, 'message' => 'success', 'data' => $data] , 200);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Request $request, $id): Response
    {
        //
        $city = City::onlyTrashed()->findOrFail($id);
        $restored = $city->restore();
        return new Response(['status' => $restored]);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Request $request, $id): Response
    {
        //
        $city = City::withTrashed()->findOrFail($id);
        $deleted = $city->forceDelete();
        return new Response(['status' => $deleted]);
    }
}
