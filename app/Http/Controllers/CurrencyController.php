<?php

namespace App\Http\Controllers;

use App\Http\Resources\CurrencyResource;
use App\Http\Resources\CurrencyResourceCollection;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CurrencyController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Currency::class, 'currency');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorize('viewAny', Currency::class);

        $currencies = Currency::all();
        $data = CurrencyResource::collection($currencies);
        return response()->json(['status' => true, 'message' => 'success', 'data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->authorize('create', Currency::class);

        $valid = validator($request->all(), [
            'name' => 'required|string|min:2|max:20|unique:currencies,name',
            'abbreviation' => 'required|string|max:10',
        ]);

        // store
        if (!$valid->fails()) {
            // Eloquent
            $currency = new Currency();
            $currency->name = $request->input('name');
            $currency->abbreviation = $request->input('abbreviation');
            $saved = $currency->save();
            return new Response(
                ['data' => $currency, 'message' => $saved ? 'Created Currency Successfully' : 'Created Currency Failed!'],
                $saved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return new Response(['message' => $valid->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Currency $currency)
    {
        // $this->authorize('view', $currency);

        return new CurrencyResource($currency);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Currency $currency)
    {
        // $this->authorize('update', $currency);

        // validate
        $valid = validator($request->all(), [
            'name' => 'required|string|min:2|max:20',
            'abbreviation' => 'required|string|max:10',
        ]);

        // store
        if (!$valid->fails()) {
            // $currency = Currency::findOrFail($id);
            $currency->name = $request->input('name');
            $currency->abbreviation = $request->input('abbreviation');
            $update = $currency->save();
            return new Response(
                ['data' => $currency, 'message' => $update ? 'Updated Currency Successfully' : 'Updated Currency Failed!'],
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
        $currency = Currency::findOrFail($id);
        // $this->authorize('delete', $currency);

        $deleted = $currency->delete();
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
        $Currency = Currency::onlyTrashed()->get();
        $data = CurrencyResource::collection($Currency);
        return response()->json(['status' => true, 'message' => 'success', 'data' => $data], 200);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Request $request, $id): Response
    {
        $currency = Currency::onlyTrashed()->findOrFail($id);
        // $this->authorize('restore', $currency);

        $restored = $currency->restore();
        return new Response(['status' => $restored]);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Request $request, $id): Response
    {

        $currency = Currency::withTrashed()->findOrFail($id);
        // $this->authorize('forceDelete', $currency);

        $deleted = $currency->forceDelete();
        return new Response(['status' => $deleted]);
    }
}
