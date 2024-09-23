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

    public function store(ClientRequest $request)
    {
    
        // dd($request);
        Client::store($request);
        return redirect()->route('admin.clients-data.index')->with('success', 'Client created successfully.');
    }


    //======================Updte categories==================//

    public function edit(Client $client)
    {
        return view('setting.clients.edit', compact('client'));
    }

    public function update(Request $request, string $id)
    {

        Client::store($request, $id);
        return redirect()->route('admin.clients-data.index')->with('success', 'Client updated successfully.');
    }

    //========================Remove category =========================//

    public function destroy(Client $category)
    {
        $category->delete();

        return redirect()->route('admin.clients-data.index')->with('success', 'Client deleted successfully.');
    }
}
