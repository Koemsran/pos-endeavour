<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        return view('setting.calendars.index');
    }
    public function getEvents(){
        $schedules = Schedule::all();
        return response()->json($schedules);
    }
}
