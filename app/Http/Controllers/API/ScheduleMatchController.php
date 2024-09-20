<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ScheduleMatch;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;

class ScheduleMatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = ScheduleMatch::all();
        return response()->json(['succes'=>true, 'data'=>$schedules], 200);
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'team1_name' => 'required|string|max:255',
            'team1_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'team2_name' => 'required|string|max:255',
            'team2_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date_match' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'location' => 'required|string|max:255',
        ]);

        $scheduleMatch = ScheduleMatch::store($request);
        return response()->json(['success'=>true, 'message'=>'Schedule created successfully', 'data'=>$scheduleMatch], 200);
    }

   
}
