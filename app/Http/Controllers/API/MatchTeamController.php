<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\MatchTeamResource;
use App\Models\MatchTeam;
use Illuminate\Http\Request;

class MatchTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matchTeams = MatchTeam::all();
        $matchTeams = MatchTeam::latest()->get();
        $matchTeams = MatchTeamResource::collection($matchTeams);
        return response()->json(['sucess' => true, 'data' => $matchTeams]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        MatchTeam::store($request);
        return response()->json(['success' => true, 'message' =>'created successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        MatchTeam::find($id)->delete();
        return response()->json(['success' => true, 'message' => 'deleted successfully']);
    }
}
