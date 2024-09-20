<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;
use Illuminate\Support\Facades\Auth;

class DiscountController extends Controller
{

    //==============Listing dicount =================//
    public function index()
    {
        $user = Auth::user();

        // Fetch discounts based on user role
        if ($user->isAdmin()) {
            // Admin can see all discounts
            $discounts = Discount::with('products')->get();
        } else {
            // Owner can see only their own discounts
            $discounts = Discount::whereHas('products', function ($query) use ($user) {
                $query->where('owner_id', $user->id);
            })->with('products')->get();
        }

        return view('setting.discounts.index', compact('discounts'));
    }

    //==============Create dicount =================//
    public function create()
    {
        $products = Product::where('owner_id', Auth::id())->get(); // Owner can only create discounts for their own products
        return view('setting.discounts.create', compact('products'));
    }

    public function store(DiscountRequest $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id',
            'discount' => 'required|numeric|min:0|max:100',
        ]);

        $discount = Discount::create([
            'title' => $request->title,
            'discount' => $request->discount,
        ]);

        $discount->products()->attach($request->product_id);

        // return redirect()->route('admin.discounts.index')->with('success', 'Discount created successfully.');
        return redirect()->route('admin.discounts.index')->with('success', 'Your product has a discount successfully.');
    }


    //==================Update discount================//
    public function edit(Discount $discount)
    {
        $products = Product::where('owner_id', Auth::id())->get(); // Owner can only edit discounts for their own products
        return view('setting.discounts.edit', compact('discount', 'products'));
    }

    public function update(Request $request, Discount $discount)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id',
            'discount' => 'required|numeric|min:0|max:100',
        ]);

        $discount->update([
            'title' => $request->title,
            'discount' => $request->discount,
        ]);

        $discount->products()->sync($request->product_id);

        return redirect()->route('admin.discounts.index')->with('success', 'Discount updated successfully.');
    }
      
    //================Delete discount================//
    public function destroy(Discount $discount)
    {
        $discount->products()->detach();
        $discount->delete();
        return redirect()->route('admin.discounts.index')->with('success', 'Discount deleted successfully.');
    }
}
