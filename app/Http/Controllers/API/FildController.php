<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FieldRequest;
use App\Http\Resources\FieldResource;
use App\Http\Resources\FieldShowResource;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fields = Field::latest()->get();;
        $fields = FieldResource::collection($fields);
        return response()->json(
            [
                'success' => true,
                'data' => $fields
            ]
        ); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FieldRequest $request)
    {

        Field::store($request);

        return response()->json(
            [
                'success' => true,
                'message' => 'Field created successfully'
            ]
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $field = Field::find($id);
        $field = new FieldShowResource($field);
        if ((!$field)) {
            return response()->json(['message' => 'Field not found'], 404);
        }
        return response()->json(['success'=>true, 'data' => $field]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FieldRequest $request, string $id)
    {
        
        Field::store($request, $id);
        return response()->json(
            [
                'success' => true,
                'message' => 'Field updated successfully'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $field = Field::find($id);
        if (is_null($field)) {
            return response()->json(['message' => 'Field not found'], 404);
        }
        $field->delete();
        return response()->json(['success'=>true, 'message' => 'Field deleted successfully'], 200);
    }
}
