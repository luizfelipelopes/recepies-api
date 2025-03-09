<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\RecipieStoreRequest;
use App\Http\Requests\Api\V1\RecipieUpdateRequest;
use App\Http\Resources\Api\V1\RecipiesCollection;
use App\Http\Resources\Api\V1\RecipiesResource;
use App\Models\Recipie;

class RecipiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipies = Recipie::query()->paginate(10);
        
        return new RecipiesCollection($recipies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RecipieStoreRequest $request)
    {
        return new RecipiesResource(Recipie::create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $recipie = Recipie::find($id);

        if(!$recipie) {
            return response()->json(['message' => __('Recipie not found')], 404);
        }

        return new RecipiesResource($recipie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RecipieUpdateRequest $request, Recipie $recipy)
    {
        $recipy->update($request->validated());

        return new RecipiesResource($recipy);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $recipy = Recipie::find($id);

        if(!$recipy) {
            return response()->json(['message' => __('Recipie not found')], 404);
        }

        $recipy->delete();

        return response()->json(['message' => __('Recipie deleted')]);
    }
}
