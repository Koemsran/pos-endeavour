<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Client;
use App\Models\Paid;
use App\Models\User;
use App\Models\PhoneConsultation;
use App\Models\OfficeConsultation;
use App\Models\Contract;
use App\Models\Refund;
use App\Models\Inprocess;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total counts (existing data)
        $totalUsers = User::count();
        $totalClients = Client::count();
        $totalBookings = Booking::sum('amount');
        $totalPaid = Paid::sum('amount');

        // Data for this year (clients and bookings grouped by month)
        $clientGrowthData = [];
        $bookingData = [];

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

        // Client progress data with zero counts included
        $clientProgress = [
            'Phone Consultation' => PhoneConsultation::distinct('progress_id')->count('progress_id'),
            'Office Consultation' => OfficeConsultation::distinct('progress_id')->count('progress_id'),
            'Booking' => Booking::distinct('progress_id')->count('progress_id'),
            'Contract' => Contract::distinct('progress_id')->count('progress_id'),
            'Refund' => Refund::distinct('progress_id')->count('progress_id'),
            'In Process' => Inprocess::distinct('progress_id')->count('progress_id'),
            'Paid' => Paid::distinct('progress_id')->count('progress_id'),
        ];

        // Loop through each month up to the current month
        foreach (range(1, Carbon::now()->month) as $month) {
            // Count clients added in each month of the current year
            $clientGrowthData[] = Client::whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', $month)
                ->count();

            // Sum of booking amounts in each month of the current year
            $bookingData[] = Booking::whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', $month)
                ->sum('amount');
        }

        // Count the number of clients by country
        $countryData = PhoneConsultation::select('prefer_country', \DB::raw('count(*) as total'))
            ->groupBy('prefer_country')
            ->orderBy('total', 'desc')
            ->get();

        // Extract country names and counts for the chart
        $countryNames = $countryData->pluck('prefer_country')->toArray(); // Country names
        $countryCounts = $countryData->pluck('total')->toArray(); // Country counts

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
            'clientProgress' => $clientProgress, // Pass client progress data
            'countryNames' => $countryNames, // Country names for the chart
            'countryCounts' => $countryCounts, // Country counts for the chart
            'clientGrowthData' => $clientGrowthData, // Client growth data for chart
            'bookingData' => $bookingData, // Booking data for chart
        ]);
    }
}
