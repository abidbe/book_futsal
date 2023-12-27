<?php

namespace App\Http\Controllers;

use App\Charts\PemasukanChart;
use App\Models\Booking;
use App\Models\Lapangan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(PemasukanChart $chart)
    {
        $chart = $chart->build();
        $users = User::where('is_admin', 0)->count();
        $bookingsukses = Booking::where('status', 1)->count();
        $bookingpending = Booking::where('status', 0)->count();
        $bookingtotal = Booking::totalSaldo();
        // dd($bookingtotal);
        // $bookings = Booking::where('status', 1)->get();
        // $totalSaldo = 0;

        // foreach ($bookings as $booking) {
        //     $from = Carbon::parse($booking->from);
        //     $to = Carbon::parse($booking->to);
        //     $hourDifference = $to->diffInHours($from);

        //     $totalSaldo += $booking->lapangan->price * $hourDifference;
        // }

        return view('admin.dashboard', compact('users', 'bookingsukses', 'bookingpending', 'bookingtotal', 'chart'));
    }
}
