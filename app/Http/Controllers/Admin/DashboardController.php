<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

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
        $weeklyUsers = [];

        // Data for today =============================================================================================
        $todayUsers = User::whereDate('created_at', Carbon::today())->count();

        foreach ($daysOfWeek as $day) {
            $totalUsersRegister = User::whereDate('created_at', Carbon::parse('this week ' . $day)->format('Y-m-d'))
                ->count();

            $weeklyUsers[] = $totalUsersRegister; // Store total bookings for each day
        }

        $totalUsersRegister = array_sum($weeklyUsers); // Total sum for the week

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
 
             $weekUsers = User::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
 
             $monthlyData['users'][] = $weekUsers;
 
             $startOfWeek->addWeek();
        }

        // Data for years =============================================================================================
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();
        $yearlyData = [
            'users' => User::whereBetween('created_at', [$startOfYear, $endOfYear])->count(),
        ];

        return view('dashboard', compact(
            'totalUsers',
            'todayUsers','monthlyData', 'yearlyData',
            'adminCount',
        ));
    
    }

}
