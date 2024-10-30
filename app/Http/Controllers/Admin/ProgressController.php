<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProgressResource;
use App\Models\Category;
use App\Models\Client;
use App\Models\Progress;
use Illuminate\Http\Request;

use function Laravel\Prompts\progress;

class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $progress = Progress::where('client_id', $id)->first();
        $client = Client::find($id);
        $categories = Category::all();
        return view('setting.clients-progress.index', compact(['progress', 'client', 'categories']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id)
    {
        try {
            // Fetch progress and increment step_number if it exists
            $progress = Progress::findOrFail($id);
            if ($progress) {
                $progress->step_number += 1; // Increment the step_number by 1
                $progress->save();           // Save the updated progress
            }
            // Redirect to a success page with a success message
            return redirect()->route('client.progress.index')->with('success', 'Booking created successfully.');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error creating booking: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Failed to create booking. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
