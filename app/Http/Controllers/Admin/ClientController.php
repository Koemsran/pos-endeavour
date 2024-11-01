<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Progress;

class ClientController extends Controller
{
    //=====================Listing Clients =================//
    public function index(Request $request)
    {
        $search = $request->input('search');
        $clients = Client::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        })->latest()->get();

        return view('setting.clients-data.index', compact('clients'));
    }

    //=================Create Client ============================//
    public function create()
    {
        return view('setting.clients-data.new');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|numeric',
            'phone_number' => 'required|string',
            'gender' => 'required|string',
            'consultant' => 'required|string|max:255',
            'register_date' => 'required|date',
            'status' => 'required|string',
            'paid' => 'nullable|string',
            'paid_amount' => 'nullable|numeric|decimal:0,2',
        ]);

        $client = new Client();
        $client->fill($validatedData);
        $client->save();

        $progress = new Progress();
        $progress->client_id = $client->id;
        $progress->step_number = 0;
        $progress->save();

        return redirect()->route('admin.clients.index')->with('success', 'Client created successfully.');
    }

    //======================Edit Client==================//
    public function edit(Client $client)
    {
        return view('setting.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|numeric',
            'phone_number' => 'required|string',
            'gender' => 'required|string',
            'consultant' => 'required|string|max:255',
            'register_date' => 'required|date',
            'status' => 'required|string',
            'paid' => 'nullable|string',
            'paid_amount' => 'nullable|decimal',
        ]);

        $client->update($validatedData);

        return redirect()->route('admin.clients.index')->with('success', 'Client updated successfully.');
    }

    //========================Remove Client =========================//
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('admin.clients.index')->with('success', 'Client deleted successfully.');
    }
}
