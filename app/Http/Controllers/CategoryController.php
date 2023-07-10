<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryResourceCollection;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eloquent
        $this->authorize('viewAny' , Category::class);
        $category = Category::paginate(10); //Pagination
        return new CategoryResourceCollection($category);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create' , Category::class);
        // validate
        $valid = validator($request->all(), [
            'name' => 'required|string|min:2|max:45|unique:categories,id',
            'description' => 'nullable|string|max:2000',
        ]);

        // store
        if (!$valid->fails()) {
            // Eloquent
            $category = new Category();
            $category->name = $request->input('name');
            $category->description = $request->input('description');
            $saved = $category->save();
            return new Response(
                ['data' => $category, 'message' => $saved ? 'Created Category Successfully' : 'Created Category Failed!'],
                $saved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return new Response(['message' => $valid->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $this->authorize('view' , $category);
        return new CategoryResource($category);
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
        ]);

        // store
        if (!$valid->fails()) {
            // Eloquent
            $category = Category::findOrFail($id);
            $this->authorize('update' , $category);
            $category->name = $request->input('name');
            $category->description = $request->input('description');
            $update = $category->save();
            return new Response(
                ['data' => $category, 'message' => $update ? 'Updated Category Successfully' : 'Updated Category Failed!'],
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
        $category = Category::findOrFail($id);
        $this->authorize('delete' , $category);
        $deleted = $category->delete();
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
        $category = Category::onlyTrashed()->get();
        $data = CategoryResource::collection($category);
        return response()->json(['status' => true, 'message' => 'success', 'data' => $data], 200);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Request $request, $id): Response
    {
        //
        $category = Category::onlyTrashed()->findOrFail($id);
        $this->authorize('restore' , $category);
        $restored = $category->restore();
        return new Response(['status' => $restored]);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Request $request, $id): Response
    {
        //
        $category = Category::withTrashed()->findOrFail($id);
        $this->authorize('forceDelete' , $category);
        $deleted = $category->forceDelete();
        return new Response(['status' => $deleted]);
    }
}
