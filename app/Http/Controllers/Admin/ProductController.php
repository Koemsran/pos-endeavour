<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all(); // Fetch all categories for the dropdown

        $productsQuery = Product::query();

        // Check if category filter is applied
        if ($request->has('category') && $request->category != '') {
            $category_id = $request->category;

            // If category ID is provided and not empty, filter by category
            if (!empty($category_id)) {
                $productsQuery->where('category_id', $category_id);
            }
        }

        $products = $productsQuery->latest()->get();

        return view('setting.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        return view('setting.products.new', compact('categories', 'colors', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // adjust max file size if needed
            'category_id' => 'nullable|exists:categories,id', // ensure category exists in database, allow null
            'colors' => 'nullable|array',
            'colors.*' => 'exists:colors,id',
            'sizes' => 'nullable|array',
            'sizes.*' => 'exists:sizes,id',
        ]);

        // Handle file upload (image)
        $imageName = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/images', $imageName);

        // Create new product
        $product = new Product();
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->image = 'images/' . $imageName; // assuming storage symlink is set up
        $product->category_id = $validatedData['category_id'];
        $product->owner_id = Auth::id(); 
        $product->save();

        // Attach colors and sizes
        $product->colors()->attach($validatedData['colors'] ?? []);
        $product->sizes()->attach($validatedData['sizes'] ?? []);
        // dd($product->colors()->attach($validatedData['colors'] ?? []));

        // Redirect to a success page or back to the form with a success message
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $colors = Color::all();
        $sizes = Size::all();
        return view('setting.products.edit', compact('product', 'categories', 'colors', 'sizes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // adjust max file size if needed
            'category_id' => 'nullable|exists:categories,id', // ensure category exists in database, allow null
            'colors' => 'nullable|array',
            'colors.*' => 'exists:colors,id',
            'sizes' => 'nullable|array',
            'sizes.*' => 'exists:sizes,id',
        ]);

        // Handle file upload (image) if provided
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $imageName);
            $product->image = 'images/' . $imageName; // assuming storage symlink is set up
        }

        // Update product details
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->category_id = $validatedData['category_id'];
       
        $product->save();

        // Sync colors and sizes
        $product->colors()->sync($validatedData['colors'] ?? []);
        $product->sizes()->sync($validatedData['sizes'] ?? []);

        // Redirect back with success message
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
