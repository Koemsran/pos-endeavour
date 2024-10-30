<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paid;
use App\Models\Progress;
use Illuminate\Http\Request;

class PaidController extends Controller
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
            'amount' => 'required|numeric',
            'paid_date' => 'nullable|date',
        ]);

        try {
            // Create new phone consultation using mass assignment
            Paid::create($validatedData);

            // Fetch progress and increment step_number if it exists
            $progress = Progress::find($validatedData['progress_id']);
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $phoneConsult = Paid::where('progress_id', $id)->first();

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
        // Validate the incoming request data
        $validatedData = $request->validate([
            'progress_id' => 'required|numeric',
            'client_id' => 'required|numeric',
            'amount' => 'required|numeric',
            'paid_date' => 'nullable|date',
        ]);

        try {
            // Find the Paid record by ID and update it
            $paid = Paid::where('progress_id', $id)->first();

            // Update the Paid record with validated data
            $paid->update($validatedData);

            // Redirect to a success page with a success message
            return redirect()->route('client.progress.index')->with('success', 'Payment updated successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Log the error if the Paid record is not found
            \Log::error('Paid record not found: ' . $e->getMessage());

            // Redirect back with an error message if the Paid record was not found
            return redirect()->back()->with('error', 'Payment record not found.');
        } catch (\Exception $e) {
            // Log any other unexpected errors for debugging
            \Log::error('Error updating payment: ' . $e->getMessage());

            // Redirect back with a general error message
            return redirect()->back()->with('error', 'Failed to update payment. Please try again.');
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
