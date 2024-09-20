<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SlideShow;
use Illuminate\Http\Request;

class SlideShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slideshows = SlideShow::all();
        return view('setting.slideshow.index', compact('slideshows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('setting.slideshow.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file upload (image)
        $imageName = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/images', $imageName);

        // Create new slideshow entry
        $slideshow = new SlideShow();
        $slideshow->image = 'images/' . $imageName; // assuming storage symlink is set up
        $slideshow->save();

        // Redirect to a success page or back to the form with a success message
        return redirect()->route('admin.slideshow.index')->with('success', 'SlideShow image uploaded successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SlideShow $slideshow)
    {
        return view('setting.slideshow.edit', compact('slideshow'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SlideShow $slideshow)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file upload (image) if provided
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $imageName);
            $slideshow->image = 'images/' . $imageName; // assuming storage symlink is set up
        }

        $slideshow->save();

        // Redirect back with success message
        return redirect()->route('admin.slideshow.index')->with('success', 'SlideShow image updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SlideShow $slideshow)
    {
        $slideshow->delete();

        return redirect()->route('admin.slideshow.index')->with('success', 'SlideShow image deleted successfully.');
    }
}
