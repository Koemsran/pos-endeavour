<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    //=====================Listing Categories =================//
    public function index(Request $request)
    {
        $search = $request->input('search');

        $clientQuery = Client::query();

        if ($search) {
            // Search for categories by name
            $clientQuery->where('name', 'like', '%' . $search . '%');
        }

        $clients = $clientQuery->latest()->get();

        if ($request->ajax()) {
            return response()->json(['clients' => $clients]);
        }

        return view('setting.clients-data.index', compact('clients'));
    }

    //=================Create categories ============================//


    public function create()
    {
        return view('setting.clients-data.new');
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|numeric',
            'phone_number' => 'required|string|min:0',
        ]);

        // Create new product
        $client = new Client();
        $client->name = $validatedData['name'];
        $client->age = $validatedData['age'];
        $client->phone_number = $validatedData['phone_number'];
        $client->save();

        // Redirect to a success page or back to the form with a success message
        return redirect()->route('admin.clients.index')->with('success', 'Client created successfully.');
    }

    //======================Updte categories==================//

    public function edit(Client $client)
    {
        return view('setting.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        // Validate incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|numeric',
            'phone_number' => 'required|string|min:0',
        ]);

        // Update client details
        $client->name = $validatedData['name'];
        $client->age = $validatedData['age'];
        $client->phone_number = $validatedData['phone_number'];

        $client->save();
        // Redirect back with success message
        return redirect()->route('admin.clients.index')->with('success', 'Client updated successfully.');
    }

    //========================Remove category =========================//

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('admin.clients.index')->with('success', 'Client deleted successfully.');
    }
}
