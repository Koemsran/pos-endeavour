<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
   //=================Get all products=================//
    public function index()
    {
        $products = Product::with(['category', 'colors', 'sizes', 'discounts'])->get();
        // Filter products with discounts
        $productsWithDiscounts = $products->filter(function ($product) {
            return $product->discounts->isNotEmpty();
        });

        return response()->json([
            'all_products' => $products,
            'products_with_discounts' => $productsWithDiscounts,
        ]);
    }

    //====================Create products =================//
    public function store(ProductRequest $request)
    {
        if (Auth::check()) {
            $validatedData = $request->validated();

            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $imageName);

            $product = new Product();
            $product->name = $validatedData['name'];
            $product->owner_id = Auth::id();
            $product->description = $validatedData['description'];
            $product->price = $validatedData['price'];
            $product->image = 'images/' . $imageName;
            $product->category_id = $validatedData['category_id'];
            $product->save();

            // Sync colors and sizes if provided
            if (isset($validatedData['color_ids'])) {
                $product->colors()->sync($validatedData['color_ids']);
            }

            if (isset($validatedData['size_ids'])) {
                $product->sizes()->sync($validatedData['size_ids']);
            }

            return response()->json([
                'success' => true,
                'message' => 'Product created successfully',
            ], 201);
        } else {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
    }
    //=====================Show specific products====================//
    public function show($id)
    {
        try {
            $product = Product::with(['category', 'colors', 'sizes', 'discounts'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $product,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Product not found'], 404);
        }
    }

    //========================Update products =========================//
    public function update(ProductRequest $request, $id)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $validatedData = $request->validated();

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $imageName);
            $product->image = 'images/' . $imageName;
        }

        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->category_id = $validatedData['category_id'];
        $product->save();

        if (isset($validatedData['color_ids'])) {
            $product->colors()->sync($validatedData['color_ids']);
        }

        if (isset($validatedData['size_ids'])) {
            $product->sizes()->sync($validatedData['size_ids']);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
        ]);
    }


    //================Remove Product =================//
    public function destroy($id)
    {
        if (Auth::check()) {
            $product = Product::findOrFail($id);

            // Delete the image from storage
            Storage::delete('public/' . $product->image);

            $product->delete();

            return response()->json([
                'success' => true,
                'message' => 'Product deleted successfully',
            ]);
        } else {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
    }
    
}
