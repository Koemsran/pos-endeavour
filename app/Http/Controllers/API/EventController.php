<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource
     * Resouce
     */
    public function index($id)
    {
        $events = Event::where('field_id', $id)->get();
        $events = EventResource::collection($events);
        if(!$events){
            return response()->json(['success' => false,'message' => 'No events found for this field'], 404);
        }
        return response()->json(['success' =>true, 'data' => $events]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        Event::store($request);
        return response()->json(['success'=>true,'message' => 'Event created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    
}
