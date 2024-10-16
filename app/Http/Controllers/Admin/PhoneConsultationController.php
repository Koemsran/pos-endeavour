<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\PhoneConsultation;
use App\Models\Progress;
use Illuminate\Http\Request;

class PhoneConsultationController extends Controller
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
            'name' => 'required|string|max:255',
            'age' => 'required|numeric',
            'phone_number' => 'required|string', // Change validation if needed
            'progress_id' => 'required|numeric',
            'source' => 'nullable|string',
            'ielts' => 'nullable|numeric',
            'hsk' => 'nullable|numeric',
            'grade' => 'required|string',
            'major' => 'required|string',
            'prefer_school' => 'required|string',
            'program_looking' => 'required|string',
            'prefer_country' => 'required|string',
        ]);

        try {
            // Create new phone consultation using mass assignment
            PhoneConsultation::create($validatedData);

            // Fetch progress and increment step_number if it exists
            $progress = Progress::find($validatedData['progress_id']);
            if ($progress) {
                $progress->step_number += 1; // Increment the step_number by 1
                $progress->save();           // Save the updated progress
            }

            // Redirect to a success page with a success message
            return redirect()->route('client.progress.index')->with('success', 'Phone consultation created successfully.');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error creating phone consultation: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Failed to create phone consultation. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $phoneConsult = PhoneConsultation::where('progress_id', $id)->first();

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
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|numeric',
            'phone_number' => 'required|string', // Change validation if needed
            'progress_id' => 'required|numeric',
            'source' => 'nullable|string',
            'ielts' => 'nullable|numeric',
            'hsk' => 'nullable|numeric',
            'grade' => 'required|string',
            'major' => 'required|string',
            'prefer_school' => 'required|string',
            'program_looking' => 'required|string',
            'prefer_country' => 'required|string',
        ]);

        try {
            // Create new phone consultation using mass assignment
            $phoneConsult = PhoneConsultation::find($id);
            $phoneConsult->update($validatedData);

            // Redirect to a success page with a success message
            return redirect()->route('client.progress.index')->with('success', 'Phone consultation created successfully.');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error creating phone consultation: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Failed to create phone consultation. Please try again.');
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
