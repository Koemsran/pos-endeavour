<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class StripePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Your code here
    }

    /**
     * Handle the payment process.
     */
    public function makePayment(Request $request)
    {
        // Set your secret key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // Create a PaymentIntent to charge a customer
            $paymentIntent = PaymentIntent::create([
                'amount' => $request->amount, // Amount in cents
                'currency' => 'usd',
                'payment_method_types' => ['card'],
                'description' => 'Example Payment',
            ]);

            // Return client secret to frontend
            return response()->json(['clientSecret' => $paymentIntent->client_secret]);
        } catch (ApiErrorException $e) {
            // Handle error
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Your code here
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Your code here
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Your code here
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Your code here
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Your code here
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Your code here
    }
}
