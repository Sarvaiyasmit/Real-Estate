<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Enquiry;
use App\Models\User;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $totalApartments = Apartment::count();
        $availableApartments = Apartment::where('status', 'available')->count();
        $reservedApartments = Apartment::where('status', 'reserved')->count();
        $totalUsers = User::where('is_admin', false)->count();
        $totalEnquiries = Enquiry::count();
        $newEnquiries = Enquiry::where('status', 'new')->count();

        $recentApartments = Apartment::latest()->take(5)->get();
        $recentEnquiries = Enquiry::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalApartments',
            'availableApartments',
            'reservedApartments',
            'totalUsers',
            'totalEnquiries',
            'newEnquiries',
            'recentApartments',
            'recentEnquiries',
        ));
    }
}
