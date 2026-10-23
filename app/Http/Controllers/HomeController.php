<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $hasApartments = Schema::hasTable('apartments');

        $featuredApartments = $hasApartments ? Apartment::take(6)->get() : collect();
        $totalResidences = $hasApartments ? Apartment::count() : 25;
        $availableResidences = $hasApartments ? Apartment::where('status', 'available')->count() : 18;

        return view('home', compact('featuredApartments', 'totalResidences', 'availableResidences'));
    }
}
