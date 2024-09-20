<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Feedback;
use App\Models\Field;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBookings = Booking::count();
        $totalUsers = User::count();
        $totalFields = Field::count();
        $totalFeedbacks = Feedback::count();
        $totalPayments = Payment::sum('amount'); // Total amount of all payments
        $payments = Payment::with('customer')->get();
        $totalAmount = $payments->sum('amount');

        // Get user count by roles
        $adminCount = User::whereHas('roles', function($query) {
            $query->where('name', 'admin');
        })->count();

        $ownerCount = User::whereHas('roles', function($query) {
            $query->where('name', 'owner');
        })->count();

        $customerCount = User::whereHas('roles', function($query) {
            $query->where('name', 'customer');
        })->count();

        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $weeklyPayment = [];
        $weeklyDataField = [];
        $weeklyUsers = [];

        // Data for today =============================================================================================

        $todayBookings = Booking::whereDate('created_at', Carbon::today())->count();
        $todayUsers = User::whereDate('created_at', Carbon::today())->count();
        $todayFields = Field::whereDate('created_at', Carbon::today())->count();
        $todayFeedbacks = Feedback::whereDate('created_at', Carbon::today())->count();
        $todayPayments = Payment::whereDate('created_at', Carbon::today())->sum('amount');

        // Data for week =============================================================================================

        foreach ($daysOfWeek as $day) {
            $totalAmount = Payment::whereDate('created_at', Carbon::parse('this week ' . $day)->format('Y-m-d'))
                ->sum('amount');

            $weeklyPayment[] = $totalAmount > 0 ? $totalAmount : 0; // Store total amount for each day
        }

        $totalWeekAmount = array_sum($weeklyPayment); // Total sum for the week

        foreach ($daysOfWeek as $day) {
            $totalBookingField = Booking::whereDate('created_at', Carbon::parse('this week ' . $day)->format('Y-m-d'))
                ->count();

            $weeklyDataField[] = $totalBookingField; // Store total bookings for each day
        }

        $totalWeekBookings = array_sum($weeklyDataField); // Total sum for the week

        foreach ($daysOfWeek as $day) {
            $totalUsersRegister = User::whereDate('created_at', Carbon::parse('this week ' . $day)->format('Y-m-d'))
                ->count();

            $weeklyUsers[] = $totalUsersRegister; // Store total bookings for each day
        }

        $totalUsersRegister = array_sum($weeklyUsers); // Total sum for the week

        foreach ($daysOfWeek as $day) {
            $totalWeekField = Field::whereDate('created_at', Carbon::parse('this week ' . $day)->format('Y-m-d'))
                ->count();

            $weeklyField[] = $totalWeekField; // Store total bookings for each day
        }

        $totalWeekField = array_sum($weeklyField); // Total sum for the week

        foreach ($daysOfWeek as $day) {
            $totalWeekFeedback = Feedback::whereDate('created_at', Carbon::parse('this week ' . $day)->format('Y-m-d'))
                ->count();

            $weeklyFeedback[] = $totalWeekFeedback; // Store total bookings for each day
        }

        $totalWeekFeedback = array_sum($weeklyFeedback); // Total sum for the week

        // // Get top 5 product orders with orders and calculate percentages
        // $productOrders = Product::withCount('orders')
        //     ->having('orders_count', '>', 0)
        //     ->orderByDesc('orders_count')
        //     ->take(5)
        //     ->get();

        // $totalOrders = Order::count();

        // $productData = $totalOrders > 0 ? $productOrders->map(function ($product) use ($totalOrders) {
        //     return [
        //         'name' => $product->name,
        //         'percentage' => ($product->orders_count / $totalOrders) * 100,
        //     ];
        // }) : collect([]);

        // Get top 5 product orders with orders and calculate percentages
        $productOrders = Product::withCount('orders')
            ->having('orders_count', '>', 0)
            ->orderBy('orders_count', 'desc')
            ->take(5)
            ->get();

        $totalOrders = Order::count();

        $productData = $productOrders->map(function ($product) use ($totalOrders) {
            return [
                'name' => $product->name,
                'percentage' => ($product->orders_count / $totalOrders) * 100,
            ];
        });


        // Data for month =============================================================================================

         $startOfMonth = Carbon::now()->startOfMonth();
         $endOfMonth = Carbon::now()->endOfMonth();
         $startOfWeek = $startOfMonth->copy()->startOfWeek();
         $monthlyData = [
             'payments' => [],
             'bookings' => [],
             'fields' => [],
             'users' => [],
             'feedback' => [],
         ];
 
         while ($startOfWeek->lessThanOrEqualTo($endOfMonth)) {
             $endOfWeek = $startOfWeek->copy()->endOfWeek()->min($endOfMonth);
 
             $weekPayments = Payment::whereBetween('created_at', [$startOfWeek, $endOfWeek])->sum('amount');
             $weekBookings = Booking::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
             $weekFields = Field::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
             $weekUsers = User::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
             $weekFeedback = Feedback::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
 
             $monthlyData['payments'][] = $weekPayments;
             $monthlyData['bookings'][] = $weekBookings;
             $monthlyData['fields'][] = $weekFields;
             $monthlyData['users'][] = $weekUsers;
             $monthlyData['feedback'][] = $weekFeedback;
 
             $startOfWeek->addWeek();
        }

        // Data for years =============================================================================================
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();
        $yearlyData = [
            'payments' => Payment::whereBetween('created_at', [$startOfYear, $endOfYear])->sum('amount'),
            'bookings' => Booking::whereBetween('created_at', [$startOfYear, $endOfYear])->count(),
            'users' => User::whereBetween('created_at', [$startOfYear, $endOfYear])->count(),
            'fields' => Field::whereBetween('created_at', [$startOfYear, $endOfYear])->count(),
            'feedback' => Feedback::whereBetween('created_at', [$startOfYear, $endOfYear])->count(),
        ];

        return view('dashboard', compact(
            'totalBookings', 'totalUsers', 'totalFields', 'totalFeedbacks','totalPayments',
            'weeklyPayment', 'weeklyDataField', 'totalWeekFeedback', 'totalWeekAmount', 'totalUsersRegister', 
            'totalWeekBookings', 'productData', 'totalOrders', 'todayBookings', 'totalWeekField',
            'todayUsers', 'todayFields', 'todayFeedbacks', 'todayPayments', 'monthlyData', 'yearlyData',
            'adminCount', 'ownerCount', 'customerCount'
        ));
    
    }

}
