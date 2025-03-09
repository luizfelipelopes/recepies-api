<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\RecipiesCollection;
use App\Http\Resources\Api\V1\RecipiesResource;
use App\Models\Recipie;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'image' => 'url|nullable',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'category' => 'required|string|in:breakfast,lunch,dinner,snack',
        ]);
        
        return new RecipiesResource(Recipie::create($request->all()));
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
    public function update(Request $request, Recipie $recipy)
    {
        $isPatch = $request->isMethod('patch');

        if($isPatch) {
            
            $request->validate([
                'title' => 'sometimes|required|string',
                'image' => 'sometimes|url|nullable',
                'ingredients' => 'sometimes|required|string',
                'instructions' => 'sometimes|required|string',
                'category' => 'sometimes|required|string|in:breakfast,lunch,dinner,snack',
            ]);

        } else {

            $request->validate([
                'title' => 'required|string',
                'image' => 'url|nullable',
                'ingredients' => 'required|string',
                'instructions' => 'required|string',
                'category' => 'required|string|in:breakfast,lunch,dinner,snack',
            ]);
        }

        $recipy->update($request->all());

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
