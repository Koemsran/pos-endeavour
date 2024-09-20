<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Http\Resources\BookingResource;
use App\Http\Resources\BookingShowResource;
use App\Models\Booking;
use App\Models\Notification;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with('options')->get();
        $bookings = BookingResource::collection($bookings);
        return response()->json(['success' => true, 'data' => $bookings]);
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
    public function store(BookingRequest $request)
    {
        $booking =  Booking::store($request);
        return response()->json(['success' => true, 'message' => "Booking created succesfully", 'data'=> $booking], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = Booking::with('options')->findOrFail($id);
        $booking = new BookingShowResource($booking);
        return response()->json(['success' => true, 'data' => $booking]);
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
    public function acceptBooking(string $id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            // Handle the case where the booking is not found
            return response()->json(['error' => 'Booking not found'], 404);
        }

        $booking->status = 'confirmed';
        $booking->save(); // Save the updated status to the database

        // Create a new notification
        $notification = new Notification();
        $notification->user_id = $booking->user_id; // Assuming Booking has a user_id field
        $notification->notification_type = 'booking_confirmed';
        $notification->notification_text = 'Your booking has been confirmed.';
        $notification->notification_data =  $booking->id;
        $notification->read = false;
        $notification->save();

        return response()->json(['success' => 'Booking confirmed successfully'], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function rejectBooking(string $id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            // Handle the case where the booking is not found
            return response()->json(['error', 'Booking not found'], 404);
        }

        $booking->status = 'rejected';
        $booking->save(); // Save the updated status to the database

        return  response()->json(['success', 'Booking rejected successfully'], 200);
    }
    public function cancelBooking(string $id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            // Handle the case where the booking is not found
            return response()->json(['error', 'Booking not found'], 404);
        }

        $booking->status = 'cancelled';
        $booking->save(); // Save the updated status to the database

        return  response()->json(['success', 'Booking cancelled successfully'], 200);
    }
    // app/Http/Controllers/BookingController.php
    public function getBookingsByUserId($id)
    {
        $bookings = Booking::where('user_id', $id)->get();
        $bookings = BookingResource::collection($bookings);
        if ($bookings->isEmpty()) {
            return response()->json(['error' => 'No bookings found for this user'], 404);
        }
        return response()->json($bookings, 200);
    }
    public function updateStatusPaymentBooking($id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            // Handle the case where the booking is not found
            return response()->json(['error', 'Booking not found'], 404);
        }

        $booking->payment_status = 'paid';
        $booking->save(); // Save the updated status to the database

        return  response()->json(['success', 'Payment status updated successfully'], 200);
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return response()->json(['message' => 'Booking deleted successfully']);
    }
}
