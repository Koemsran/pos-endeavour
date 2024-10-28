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
            'name' => 'required|string|max:255',
            'age' => 'required|numeric',
            'phone_number' => 'required|string',
            'education_level' => 'nullable|string',
            'school' => 'nullable|string',
            'language_test' => 'nullable|string',
            'prefer_university' => 'nullable|string',
            'address' => 'nullable|string',
            'major' => 'nullable|string',
            'program_looking' => 'nullable|string',
            'prefer_country' => 'nullable|string',
        ]);
        try {
            // Create new phone consultation using mass assignment
            OfficeConsultation::create($validatedData);

            // Fetch progress and increment step_number if it exists
            $progress = Progress::findOrFail($validatedData['progress_id']);
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
        try {
            $phoneConsult = OfficeConsultation::where('progress_id', $id)->first();

            if (!$phoneConsult) {
                return response()->json([
                    'success' => false,
                    'message' => 'Phone consultation not found.'
                ], 404);
            }

            // Return the phone consultation data as JSON
            return response()->json([
                'success' => true,
                'phoneConsult' => $phoneConsult
            ], 200);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error fetching phone consultation data: ' . $e->getMessage());

            // Return a JSON response for the error
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch phone consultation. Please try again.'
            ], 500);
        }
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
        // Validate incoming request
        $validatedData = $request->validate([
            'progress_id' => 'required|numeric',
            'name' => 'required|string|max:255',
            'age' => 'required|numeric',
            'phone_number' => 'required|string',
            'education_level' => 'nullable|string',
            'school' => 'nullable|string',
            'language_test' => 'nullable|string',
            'prefer_university' => 'nullable|string',
            'address' => 'nullable|string',
            'major' => 'nullable|string',
            'program_looking' => 'nullable|string',
            'prefer_country' => 'nullable|string',
        ]);
        try {
            // Create new phone consultation using mass assignment
            $officeConsultation = OfficeConsultation::findOrFail($id);
            $officeConsultation->update($validatedData);

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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
