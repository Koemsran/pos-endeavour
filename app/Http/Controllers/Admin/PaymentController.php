<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentController extends Controller
{

    //==============display list of payments============//
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            // Admin: get all payments
            $payments = Payment::latest()->get();
        } else {
            // Owner: get payments created by the owner
            $payments = Payment::where('owner_id', Auth::id())->latest()->get();
            
        }

        $totalAmount = $payments->sum('amount'); // Calculate total amount
        $payments = PaymentResource::collection($payments);
        return view('setting.payment.index', compact('payments', 'totalAmount'));
    }

   //=============show payment form============//
    public function showPaymentForm(Request $request)
    {
        $clientSecret = $this->createPaymentIntent($request);
        return view('setting.payment.form', compact('clientSecret'));
    }

    //=============show payment form for month============//
    public function showPaymentFormMonth(Request $request)
    {
        $clientSecret = $this->createPaymentIntent($request);
        return view('setting.payment.payMonth', compact('clientSecret'));
    }

    //=============create payment intent============//
    private function createPaymentIntent($request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $amount = $request->input('amount') ?? 50;
        $paymentIntent = PaymentIntent::create([
            'amount' => $amount * 100,
            'currency' => 'usd',
            'payment_method_types' => ['card'],
        ]);

        return $paymentIntent->client_secret;
    }

    //======================Create Payment====================//
    public function store(PaymentRequest $request)
    {
        $validatedData = $request->validated();

        $payment = new Payment();
        $payment->amount = $validatedData['amount'];
        $payment->save();

        return redirect()->route('admin.payments.index')->with('success', 'Payment added successfully.');
    }

}
