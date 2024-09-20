<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AddToCartResource;
use Illuminate\Http\Request;
use App\Models\AddToCard;
use Illuminate\Support\Facades\Auth;

class AddToCardController extends Controller
{
    // public function index()
    // {
    //     $cartItems = AddToCard::with('product')->get();
    //     // $cartItems = AddToCard::where('user_id', Auth::id())->with('product')->get();
    //     return response()->json(['success' => true, 'data' => $cartItems]);
    // }

   
    public function index()
    {
        $cartItems = AddToCard::with(['product', 'user']) 
            ->latest()->get();
        return response()->json(['success' => true, 'data' => $cartItems]);

    }

    // public function index()
    // {
    //     $cartItems = AddToCard::with(['product', 'colors', 'sizes', 'user'])->get();
    //     $formattedCartItems = $cartItems->map(function ($item) {
    //         return [
    //             'id' => $item->id,
    //             'user_id' => $item->user_id,
    //             'user' => $item->user->name,
    //             'product' => [
    //                 'id' => $item->product->id,
    //                 'product_id' => $item->product_id,
    //                 'name' => $item->product->name,
    //                 'description' => $item->product->description,
    //                 'price' => $item->product->price,
    //                 'category_id' => $item->product->category_id,
    //                 'image' => $item->product->image,
    //             ],
    //             'quantity' => $item->quantity,
    //             'price' => $item->price,
    //             'total_amount' => $item->total_amount,
    //         ];
    //     });

    //     return response()->json(['success' => true, 'data' => $formattedCartItems]);
    // }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            // 'color_id' => 'required|exists:colors,id',
            // 'size_id' => 'required|exists:sizes,id',
            'quantity' => 'required|integer|min:1'
        ]);

        // $cartItem = AddToCard::addToCart(Auth::id(), $validatedData['product_id'], $validatedData['quantity'],$validatedData['color_id'], $validatedData['size_id']);
        $cartItem = AddToCard::addToCart(Auth::id(), $validatedData['product_id'], $validatedData['quantity']);

        return response()->json(['message' => 'Item added to cart successfully', $cartItem], 201);
    }

    public function show(string $id)
    {
        $cartItem = AddToCard::where('user_id', Auth::id())->with('product')->findOrFail($id);
        return response()->json($cartItem);
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = AddToCard::where('user_id', Auth::id())->findOrFail($id);
        $cartItem->quantity = $validatedData['quantity'];
        $cartItem->total_amount = $cartItem->price * $validatedData['quantity'];
        $cartItem->save();

        return response()->json(['message' => 'Cart item updated successfully']);
    }

    public function destroy(string $id)
    {
        $cartItem = AddToCard::where('user_id', Auth::id())->findOrFail($id);
        $cartItem->delete();

        return response()->json(['message' => 'Item removed from cart']);
    }
    
}
