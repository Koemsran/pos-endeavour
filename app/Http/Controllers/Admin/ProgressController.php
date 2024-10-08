<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Progress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $client = Client::find($id);
        return view('setting.clients-progress.index', compact('client'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Client $client, $stepNumber)
    {
        // Mark previous step as completed
        $progress = $client->progress()->where('step_number', $stepNumber - 1)->first();
        if ($progress) {
            $progress->status = 'completed';
            $progress->completed_at = now();
            $progress->save();
        }

        // Create new entry for current step
        Progress::create([
            'client_id' => $client->id,
            'step_number' => $stepNumber,
            'status' => 'in-progress',
            'started_at' => now(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
