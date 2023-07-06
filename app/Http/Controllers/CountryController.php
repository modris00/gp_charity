<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Http\Resources\CountryResourceCollection;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //  $this->authorize('viewAny' ,  Country::class);
        $country = Country::latest()->paginate(10);
        return new CountryResourceCollection($country);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //  $this->authorize('create' ,  Country::class);
        $validator = validator($request->all(), [
            'name' => ['required', 'string', 'min:2', 'max:30', 'unique:countries,id']
        ]);

        if (!$validator->fails()) {

            $country  = new Country();
            $country->name = $request->input('name');
            $country->save();

            return new Response([
                'date' => $country,
                'message' => $country ? 'Created successfuly' : 'Error adding',
                'status' => $country ? true : false
            ], $country ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {

            return response()->json([
                'message' => $validator->getMessageBag()->first()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        // $country_cities = Country::with('cities')->findOrFail($id);
        // return new Response([
        //     'data' => $country_cities,
        //     'status' => true,
        // ], Response::HTTP_OK);
        //  $this->authorize('view' ,  $country);
        return new CountryResource($country);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $valditor = validator($request->all(), [
            'name' => [
                'required', 'string',  'min:2', 'max:20',
                Rule::unique('countries')->ignore($id)
            ]
        ]);

        if (!$valditor->fails()) {

            $country  =  country::findorfail($id);
            //  $this->authorize('update' ,  $country);
            $country->name = $request->input('name');
            $country->save();

            return new Response([
                'date' => $country,
                'message' =>  $country ?  'Update successfuly' : 'Error in the modification process',
                'status' => $country ? true : false
            ], $country ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST,);
        } else {

            return new Response([

                'message' => $valditor->getMessageBag()->first(),
                'status' => Response::HTTP_BAD_REQUEST

            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $country = Country::findorfail($id);
        //  $this->authorize('delete' ,  $country);
        $country->delete();

        if ($country) {
            return new Response([
                'object' => $country,
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
        //  $this->authorize('restore' ,  Country::class);
        $country = Country::onlyTrashed()->get();
        $data = CountryResource::collection($country);
        return response()->json(['status' => true, 'message' => 'success', 'data' => $data], 200);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Request $request, $id): Response
    {
        //
        $country = Country::onlyTrashed()->findOrFail($id);
        //  $this->authorize('restore' ,  $country);
        $restored = $country->restore();
        return new Response(['status' => $restored]);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Request $request, $id): Response
    {
        //
        $country = Country::withTrashed()->findOrFail($id);
        //  $this->authorize('forceDelete' ,  $country);
        $deleted = $country->forceDelete();
        return new Response(['status' => $deleted]);
    }
}
