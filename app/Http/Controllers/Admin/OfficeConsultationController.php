<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfficeConsultation;
use App\Models\Progress;
use Illuminate\Http\Request;

class OfficeConsultationController extends Controller
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
        // Validate incoming request
        $validatedData = $request->validate([
            'progress_id' => 'required|numeric',
            'client_id' => 'required|numeric',
            'education_level' => 'required|string',
            'school' => 'required|string',
            'language_test' => 'required|string',
            'prefer_university' => 'required|string',
            'address' => 'required|string',
            'major' => 'required|string',
            'program_looking' => 'required|string',
            'prefer_country' => 'required|string',
        ]);
        try {
            // Create new phone consultation using mass assignment
            OfficeConsultation::create($validatedData);

            // Fetch progress and increment step_number if it exists
            $progress = Progress::find($validatedData['progress_id']);
            if ($progress) {
                $progress->step_number += 1; // Increment the step_number by 1
                $progress->save();           // Save the updated progress
            }

            // Redirect to a success page with a success message
            return redirect()->route('client.progress.index')->with('success', 'Office consultation created successfully.');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error creating office consultation: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Failed to create office consultation. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
