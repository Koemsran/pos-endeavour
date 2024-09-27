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
        $events = Event::all();

        // Return events as JSON if the request expects JSON
        if (request()->ajax()) {
            return response()->json($events);
        }

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
            'start' => 'required|date', // validate as date (or datetime if time is included)
            'end' => 'required|date|after_or_equal:start', // validate as date and ensure it is after or equal to start
            'user_id' => 'nullable|exists:users,id', // ensure user exists in database, allow null
            'client_id' => 'nullable|exists:clients,id', // ensure client exists in database, allow null
        ]);

        // Create new product
        $event = new Event();
        $event->title = $validatedData['title'];
        $event->user_id = $validatedData['user_id'];
        $event->client_id = $validatedData['client_id'];
        $event->start = $validatedData['start'];
        $event->end = $validatedData['end'];
        $event->save();

        // Redirect to a success page or back to the form with a success message
        return redirect()->route('admin.schedules.index')->with('success', 'Event created successfully.');
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
            'start' => 'required|date', // validate as date (or datetime if time is included)
            'end' => 'required|date|after_or_equal:start', // validate as date and ensure it is after or equal to start
            'user_id' => 'nullable|exists:users,id', // ensure user exists in database, allow null
            'client_id' => 'nullable|exists:clients,id', // ensure client exists in database, allow null
        ]);

        // Create new calendar
        $event->title = $validatedData['title'];
        $event->user_id = $validatedData['user_id'];
        $event->client_id = $validatedData['client_id'];
        $event->start = $validatedData['start'];
        $event->end = $validatedData['end'];
        $event->save();

        // Redirect back with success message
        return redirect()->route('admin.schedules.index')->with('success', 'Calendar updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.schedules.index')->with('success', 'Event deleted successfully.');
    }
}
