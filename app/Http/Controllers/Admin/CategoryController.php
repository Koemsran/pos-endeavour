<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    //=====================Listing Categories =================//
    public function index(Request $request)
    {
        $search = $request->input('search');

        $categoriesQuery = Category::query();

        if ($search) {
            // Search for categories by name
            $categoriesQuery->where('name', 'like', '%' . $search . '%');
        }

        $categories = $categoriesQuery->latest()->get();

        if ($request->ajax()) {
            return response()->json(['categories' => $categories]);
        }

        return view('setting.categories.index', compact('categories'));
    }

    //=================Create categories ============================//

    public function create()
    {
        return view('setting.categories.new');
    }

    public function store(CategoryRequest $request)
    {
    
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);
        // dd($request);
        Category::create([
            'name' => $request->name,
            // 'owner_id' => Auth::id(), // Set the owner ID to the logged-in user
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }


    //======================Updte categories==================//

    public function edit(Category $category)
    {
        return view('setting.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update($request->only('name'));

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    //========================Remove category =========================//

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
