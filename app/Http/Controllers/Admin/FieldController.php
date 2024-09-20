<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FieldRequest;
use App\Http\Resources\FieldResource;
use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FieldController extends Controller
{
    //================Listing Fields =============================//
    public function index()
    {
        $fields = auth()->user()->isAdmin() ? Field::latest()->get() : auth()->user()->fields;

        $fields = FieldResource::collection($fields);
        return view('setting.fields.index', compact('fields'));
    }

    //=========================Create Field =========================//

    public function create()
    {
        $fields = Field::all();
        return view('setting.fields.create', compact('fields'));
    }

    public function store(FieldRequest $request)
    {
        $validated = $request->validated();
        // Store the file in the 'public' disk (or any other disk you have configured)
        $imageName = time() . '.' . $request->image->extension();
        $request->image->storeAs('public/images', $imageName);
        $validated['image'] = 'images/' . $imageName;
        $validated['owner_id'] = Auth::id();
        Field::create($validated);
        return redirect()->route('admin.fields.index')->with('success', 'Field created successfully.');
    }

    //==========================Show specific fields =========================//
    public function show($id)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $imageName);
            $validated['image'] = 'images/' . $imageName;
        }

        Field::create($validated);

        return redirect()->route('admin.fields.index')->with('success', 'Field created successfully.');
    }


    //=========================Update Field =========================//

    public function edit($id)
    {
        $field = Field::findOrFail($id);
        return view('setting.fields.edit', compact('field'));
    }

    public function update(FieldRequest $request, Field $field)
    {
        $validated = $request->validated();
        // Validate incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg,jfif,webp|max:2048',
            'price' => 'required|numeric|min:0',
            'field_type' => 'required|string|max:255',
            'owner_id' => 'nullable',
            'province' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/images', $imageName);
            $validated['image'] = 'images/' . $imageName;
        }

        $field->update($validated);
        // Update field details
        $field->name = $validatedData['name'];
        $field->location = $validatedData['location'];
        $field->price = $validatedData['price'];
        $field->field_type = $validatedData['field_type'];
        $field->province = $validatedData['province'];

        $field->save();

        return redirect()->route('admin.fields.index')->with('success', 'Field updated successfully.');
    }

    //========================Remove field =========================//
    public function destroy($id)
    {
        $field = Field::findOrFail($id);
        $field->delete();

        return redirect()->route('admin.fields.index')->with('success', 'Field deleted successfully.');
    }
}
