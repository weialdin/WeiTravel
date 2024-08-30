<?php

namespace App\Http\Controllers;

use App\Models\PackageTour;
use Illuminate\Http\Request;


class FrontController extends Controller
{
    public function index() {
        // Mengambil 3 paket tur terbaru berdasarkan ID
        $package_tours = PackageTour::orderByDesc('id')->take(3)->get();
        return view('front.index', compact('package_tours'));
    }

    public function details($slug) {
        $package_tours = PackageTour::where('slug',$slug);
        return view('front.details', compact('package_tours'));
    }
}

