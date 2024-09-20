<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeliveryResource;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum'); // Ensure that the user is authenticated
    }

    //=====================Listing delivery==================//
    public function index()
    {
        $deliveries = Delivery::with('user')->get();
        return response()->json(['success' => true, 'data' => DeliveryResource::collection($deliveries)]);
    }

    public function store(Request $request)
    {
        $delivery = Delivery::createDelivery($request);
        return response()->json(['message' => 'Delivery created successfully', 'data' => $delivery], 201);
    }

    public function show(string $id)
    {
        $delivery = Delivery::with('user')->findOrFail($id);
        return response()->json(['success' => true, 'data' => new DeliveryResource($delivery)]);
    }

    public function update(Request $request, string $id)
    {
        $delivery = Delivery::updateDelivery($request, $id);
        return response()->json(['message' => 'Delivery updated successfully', 'data' => $delivery]);
    }

    public function destroy(string $id)
    {
        $delivery = Delivery::findOrFail($id);
        $delivery->delete();
        return response()->json(['message' => 'Delivery deleted successfully', 'data' => $delivery], 204);
    }
}
