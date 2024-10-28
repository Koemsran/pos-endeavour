<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Progress;
use App\Models\Refund;
use Illuminate\Http\Request;

class RefundContrller extends Controller
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
            'refund_reason' => 'nullable|string',
        ]);
        try {
            // Create new phone consultation using mass assignment
            Refund::create($validatedData);

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
            $phoneConsult = Refund::where('progress_id', $id)->first();

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
            'refund_reason' => 'nullable|string',
        ]);

        try {
            // Find the refund by id or fail if not found
            $refund = Refund::where('progress_id', $id)->first();

            // Update the refund with the validated data
            $refund->update($validatedData);

            // Redirect to the progress index with a success message
            return redirect()->route('client.progress.index')->with('success', 'Refund updated successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Log error if the refund record was not found
            \Log::error('Refund not found: ' . $e->getMessage());

            // Redirect back with an error message if the record was not found
            return redirect()->back()->with('error', 'Refund not found.');
        } catch (\Exception $e) {
            // Log any other unexpected errors for debugging
            \Log::error('Error updating refund: ' . $e->getMessage());

            // Redirect back with a general error message
            return redirect()->back()->with('error', 'Failed to update refund. Please try again.');
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
