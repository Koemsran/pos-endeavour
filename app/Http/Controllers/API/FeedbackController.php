<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FeedbackResource;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{

    //=============Listing feedback==================//
    public function index($id)
    {
        $feedbacks = Feedback::with(['user', 'field'])
            ->where('field_id', $id) // Add this line to filter by field_id
            ->get();
        $feedbacks = FeedbackResource::collection($feedbacks);
        return response()->json(['success' => true, 'data' => $feedbacks], 201);
    }


    public function store(Request $request)
    {
        $feedback = Feedback::create([
            'user_id' => Auth::id(),
            'field_id' => $request->input('field_id'),
            'feedback_text' => $request->input('feedback_text'),
        ]);

        return response()->json(['success' => true, 'message' => 'Feedback created successfully', 'data' => $feedback], 201);
    }

    //=================Show feedback==================//
    public function show($id)
    {
        $feedback = Feedback::with(['user', 'field'])->find($id);
        if (!$feedback) {
            return response()->json(['success' => false, 'message' => 'Feedback not found'], 404);
        }
        return response()->json(['success' => true, 'data' => $feedback]);
    }

    public function update(Request $request, $id)
    {
        // Find the feedback entry by ID
        $feedback = Feedback::find($id);

        // Check if feedback entry exists
        if (!$feedback) {
            return response()->json(['success' => false, 'message' => 'Feedback not found'], 404);
        }

        // Update the feedback entry with provided data or retain existing data if not provided
        $feedback->update([
            'field_id' => $request->input('field_id', $feedback->field_id),
            'feedback_text' => $request->input('feedback_text', $feedback->feedback_text),
        ]);

        // Return success response with updated feedback data
        return response()->json(['success' => true, 'message' => 'Feedback updated successfully', 'data' => $feedback]);
    }


    public function destroy($id)
    {
        $feedback = Feedback::find($id);
        if (!$feedback) {
            return response()->json(['success' => false, 'message' => 'Feedback not found'], 404);
        }

        $feedback->delete();

        return response()->json(['success' => true, 'message' => 'Feedback deleted successfully']);
    }
}
