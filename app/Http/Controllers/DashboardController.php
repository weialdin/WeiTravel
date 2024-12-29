<?php

namespace App\Http\Controllers;

use App\Models\PackageBooking;
use App\Models\PackageTour;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; // Tambahkan Carbon untuk manipulasi tanggal

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung total paket
        $totalPackages = PackageTour::count();

        // Menghitung total pemesanan
        $totalBookings = PackageBooking::count();

        // Menghitung total user
        $totalUsers = User::count();

        // Mengambil statistik user per bulan untuk tahun ini
        $userStats = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                        ->whereYear('created_at', Carbon::now()->year)
                        ->groupBy('month')
                        ->pluck('count', 'month')->toArray();

        // Mengisi data statistik bulan yang kosong dengan 0
        $userStatistics = [];
        for ($i = 1; $i <= 12; $i++) {
            $userStatistics[$i] = $userStats[$i] ?? 0;
        }

        // Mengirim data ke tampilan
        return view('dashboard', [
            'totalPackages' => $totalPackages,
            'totalBookings' => $totalBookings,
            'totalUsers' => $totalUsers,
            'userStatistics' => $userStatistics, // Tambahkan statistik user per bulan
        ]);
    }

    public function getUserStatistics(Request $request)
    {
    $year = $request->get('year', Carbon::now()->year); // Mendapatkan tahun dari permintaan

    $userStats = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->whereYear('created_at', $year)
                ->groupBy('month')
                ->pluck('count', 'month')->toArray();

    // Mengisi data statistik bulan yang kosong dengan 0
    $userStatistics = [];
    for ($i = 1; $i <= 12; $i++) {
        $userStatistics[$i] = $userStats[$i] ?? 0;
    }

    return response()->json(array_values($userStatistics));
    }

    public function my_bookings()
    {
        return view('dashboard.my_bookings');
    }

    public function booking_details(PackageBooking $packageBooking)
    {
        return view('dashboard.booking_details', compact('packageBooking'));
    }
}
