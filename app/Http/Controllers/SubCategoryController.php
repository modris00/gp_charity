<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubCategoryResource;
use App\Http\Resources\SubCategoryResourceCollection;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $this->authorize('viewAny' , SubCategory::class);
        // $subCategories = SubCategory::with('category')->get();
        // return new SubCategoryResourceCollection($subCategories);
        // $subCategories = SubCategory::all();
        $subCategories = SubCategoryResource::collection(SubCategory::all());
        return response()->json(['status' => true, 'message' => 'success', 'data' => $subCategories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $this->authorize('create' , SubCategory::class);
        // validate
        $valid = Validator($request->all(), [
            'name' => 'required|string|min:2|max:45|unique:sub_categories,id',
            'description' => 'nullable|string|max:2000',
            'category_id' => 'required|numeric|exists:categories,id',
        ]);

        // store
        if (!$valid->fails()) {
            // Eloquent
            $subcategory = new SubCategory();
            $subcategory->name = $request->input('name');
            $subcategory->description = $request->input('description');
            $subcategory->category_id = $request->input('category_id');
            $saved = $subcategory->save();
            return new Response(
                ['data' => $subcategory, 'message' => $saved ? 'Created SubCategory Successfully' : 'Created SubCategory Failed!'],
                $saved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return new Response(['message' => $valid->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function show(SubCategory $SubCategory)
    {
        // $this->authorize('view' , $SubCategory);
        // return response()->json([
        //     "status" => "success",
        //     "object" => $SubCategory
        // ]);
        return new SubCategoryResource($SubCategory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate
        $valid = validator($request->all(), [
            'name' => 'required|string|min:2|max:45',
            'description' => 'nullable|string|max:2000',
            'category_id' => 'required|numeric|exists:categories,id',
        ]);

        // update
        if (!$valid->fails()) {
            // Eloquent
            $subcategory = SubCategory::findOrFail($id);
            // $this->authorize('update' , $subcategory);
            $subcategory->name = $request->input('name');
            $subcategory->description = $request->input('description');
            $subcategory->category_id = $request->input('category_id');
            $update = $subcategory->save();
            return new Response(
                ['data' => $subcategory, 'message' => $update ? 'Updated SubCategory Successfully' : 'Updated SubCategory Failed!'],
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
        $subcategory = SubCategory::findOrFail($id);
        // $this->authorize('delete' , $subcategory);
        $deleted = $subcategory->delete();
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
        $SubCategory = SubCategory::onlyTrashed()->get();
        $data = SubCategoryResource::collection($SubCategory);
        return response()->json(['status' => true, 'message' => 'success', 'data' => $data], 200);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Request $request, $id): Response
    {
        // $this->authorize('restore' , $subcategory);

        $subcategory = SubCategory::onlyTrashed()->findOrFail($id);
        $restored = $subcategory->restore();
        return new Response(['status' => $restored]);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Request $request, $id): Response
    {
        // $this->authorize('forceDelete' , $subcategory);
        $subcategory = SubCategory::withTrashed()->findOrFail($id);
        $deleted = $subcategory->forceDelete();
        return new Response(['status' => $deleted]);
    }
}
