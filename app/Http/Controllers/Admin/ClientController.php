<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\Progress;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    //=====================Listing Categories =================//
    public function index(Request $request)
    {
        // Get search query
        $search = $request->input('search');

        // Get clients with optional search
        $clients = Client::when($search, function ($query, $search) {
            return $query->where('name', 'LIKE', "%{$search}%");
        })->latest()->paginate(10);

        // Return the view with clients data
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

        $progress =new Progress();
        $progress->client_id = $client->id;
        $progress->step_number = 0;
        $progress->save();

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
