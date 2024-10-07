<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $events = Event::all()->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->date . 'T' . $event->start, // Ensure start is in ISO format
                'end' => $event->date . 'T' . $event->end,     // Ensure end is in ISO format
            ];
        });
        return view('setting.calendars.index', compact('events'));
    }

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
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'start' => 'required|date_format:H:i', // validate as full ISO datetime
            'end' => 'required|date_format:H:i|after_or_equal:start',
            'user_id' => 'nullable|exists:users,id',
        ]);

        // Create new event
        $event = Event::create($validatedData);

        return response()->json(['event' => $event], 201);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $event = Event::all();
        return view('setting.calendars.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'start' => 'required|date_format:H:i', // Validate as time only (H:i)
            'end' => 'required|date_format:H:i|after_or_equal:start',
            'user_id' => 'nullable|exists:users,id',
        ]);

        // Update the event
        $event->title = $validatedData['title'];
        $event->date = $validatedData['date'];
        $event->start = $validatedData['start'];
        $event->end = $validatedData['end'];
        $event->user_id = $validatedData['user_id'] ?? null; // Optional user ID
        $event->save();

        // Return the updated event as a JSON response
        return response()->json(['event' => $event]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id); // Find the event by ID or fail if not found
        $event->delete();
        return redirect()->route('admin.schedules.index')->with('success', 'Event deleted successfully.');
    }
}
