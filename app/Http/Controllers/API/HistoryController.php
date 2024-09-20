<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $histories = History::latest()->get();;
        return response()->json(['success'=>true, 'data'=>$histories], 200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        History::store($request);
        return response()->json(['success'=>true, 'message'=>'History created successfully'], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $history = History::find($id);
        dd($history);
        // $history->delete();
        // return response()->json(['success'=>true, 'message'=>'History deleted successfully'], 200);
    }
}
