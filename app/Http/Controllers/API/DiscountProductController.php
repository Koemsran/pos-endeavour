<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\DiscountResource;
use App\Http\Resources\DiscountShowResource;
use App\Models\Discount;
use App\Models\Product; // Import Product model
use Illuminate\Http\Request;

class DiscountProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $discounts = Discount::with('products')->get();
        $discounts = DiscountResource::collection($discounts);
        return response()->json(['success' => true, 'data' => $discounts], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id',
            'discount' => 'required|numeric|min:0|max:100',
        ]);

        $discount = Discount::store($request);

        return response()->json(['success' => true, 'message' => 'Discount created successfully', $discount], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $discount = Discount::with('products')->find($id);

        if (!$discount) {
            return response()->json(['success' => false, 'message' => 'Discount not found'], 404);
        }

        return response()->json(['success' => true, 'data' => new DiscountShowResource($discount)], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id',
            'discount' => 'required|numeric|min:0|max:100',
        ]);

        $discount = Discount::store($request, $id);

        return response()->json(['success' => true, 'message' => 'Discount updated successfully', $discount], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $discount = Discount::find($id);
        if (!$discount) {
            return response()->json(['success' => false, 'message' => 'Discount not found'], 404);
        }
        $discount->delete();
        return response()->json(['success' => true, 'message' => 'Discount deleted successfully'], 200);
    }

}
