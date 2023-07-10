<?php

namespace App\Http\Controllers;

use App\Http\Resources\FaqResource;
use App\Http\Resources\FaqResourceCollection;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FaqController extends Controller
{
    // public function __construct()
    // {
    //     $this->authorizeResource(Faq::class, 'faq');
    // }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $this->authorize('viewAny', Faq::class);

        $faqs = Faq::simplePaginate(10);
        $data = FaqResource::collection($faqs);
        return new Response(["status" => true, "data" => $data]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

       $this->authorize('create', Faq::class);
        $validator = validator($request->all(), [
            "question" => "string|required|min:5|max:100",
            "answer" => "string|required|min:5|max:250",
            "question_type" => "required|in:For Donor,For Beneficiary",

        ]);
        if (!$validator->fails()) {
            $data = Faq::create($request->all());
            return new Response(
                ["object" => $data, "message" => $data ? "create FAQ is successfully" : "create FAQ is failed"],
                $data ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return new Response(["status" => false, "message" => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        $this->authorize('view', $faq);
        // return new Response(["status" => true, "data" => $FAQ], Response::HTTP_OK);
        return new FAQResource($faq);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        $this->authorize('update', $faq);

        $validator = validator($request->all(), [
            "question" => "string|required|min:5|max:100",
            "answer" => "string|required|min:5|max:250",
            "question_type" => "required|in:For Donor,For Beneficiary",

        ]);
        if (!$validator->fails()) {
            $faq->question = $request->input("question");
            $faq->answer = $request->input("answer");
            $faq->question_type = $request->input("question_type");
            $saved = $faq->save();
            return new Response(
                [
                    "status" => $saved, "message" =>
                    $saved ? "Updated FAQ is successfully " : "Updated FAQ Is failed", "object" => $faq
                ],
                $saved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return new Response(["status" => false, "message" => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        $this->authorize('delete', $faq);

        $deleted = $faq->delete();
        return new Response(["status" => $deleted, "message" => "successfully deleted"], Response::HTTP_OK);
    }

    public function Archives()
    {
        $this->authorize('restore', $supplier);
        $Faq = Faq::onlyTrashed()->get();
        $data = FaqResource::collection($Faq);
        return response()->json(['status' => true, 'message' => 'success', 'data' => $data] , 200);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Request $request, $id): Response
    {
        $faq = Faq::onlyTrashed()->findOrFail($id);

      //  $this->authorize('restore', $faq);

        $restored = $faq->restore();
        return new Response(['status' => $restored]);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Request $request, $id): Response
    {
        $faq = Faq::withTrashed()->findOrFail($id);
        $this->authorize('forceDelete', $faq);

        $deleted = $faq->forceDelete();
        return new Response(['status' => $deleted]);
    }
}
