<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Paid;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total counts
        $totalUsers = User::count();
        $totalClients = Client::count();
        $totalBookings = Booking::sum('amount');
        $totalPaid = Paid::sum('amount');

        // Today's data
        $todayUsers = User::whereDate('created_at', Carbon::today())->count();
        $todayBookings = Booking::whereDate('created_at', Carbon::today())->sum('amount');
        $todayPaid = Paid::whereDate('created_at', Carbon::today())->sum('amount');
        $todayClients = Client::whereDate('created_at', Carbon::today())->count();

        // This week's data
        $totalUsersThisWeek = User::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $totalBookingsThisWeek = Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');
        $weeklyPaid = Paid::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');
        $totalClientsThisWeek = Client::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();

        // This month's data
        $totalUsersThisMonth = User::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        $totalBookingsThisMonth = Booking::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->sum('amount');
        $monthlyPaid = Paid::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->sum('amount');
        $totalClientsThisMonth = Client::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();

        // This year's data
        $totalUsersThisYear = User::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->count();
        $totalBookingsThisYear = Booking::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->sum('amount');
        $yearlyPaid = Paid::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->sum('amount');
        $totalClientsThisYear = Client::whereBetween('created_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->count();

        // Pass data to the view
        return view('dashboard', [
            'totalUsers' => $totalUsers,
            'totalClients' => $totalClients,
            'totalBookings' => $totalBookings,
            'totalPaid' => $totalPaid,
            'todayUsers' => $todayUsers,
            'todayBookings' => $todayBookings,
            'todayPaid' => $todayPaid,
            'todayClients' => $todayClients,
            'totalUsersThisWeek' => $totalUsersThisWeek,
            'totalBookingsThisWeek' => $totalBookingsThisWeek,
            'weeklyPaid' => $weeklyPaid,
            'totalClientsThisWeek' => $totalClientsThisWeek,
            'totalUsersThisMonth' => $totalUsersThisMonth,
            'totalBookingsThisMonth' => $totalBookingsThisMonth,
            'monthlyPaid' => $monthlyPaid,
            'totalClientsThisMonth' => $totalClientsThisMonth,
            'totalUsersThisYear' => $totalUsersThisYear,
            'totalBookingsThisYear' => $totalBookingsThisYear,
            'yearlyPaid' => $yearlyPaid,
            'totalClientsThisYear' => $totalClientsThisYear,
        ]);
    }
}
