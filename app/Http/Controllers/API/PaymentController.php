<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::all();
        $payments = PaymentResource::collection($payments);
        return response()->json([
            'success' => true,
            'data' => $payments
        ], 200);
    }

    
    /**
     * Store a newly created resource in storage.
     */
    public function createPayment(Request $request)
    {
        Payment::store($request);
        return response()->json(['success' => true, 'message' =>'payment created successfully'], 200);
    }

   
}
