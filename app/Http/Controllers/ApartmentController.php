<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ApartmentController extends Controller
{
    public function index(Request $request): View
    {
        $query = Apartment::query();

        if ($request->filled('typology')) {
            $query->where('typology', $request->typology);
        }

        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', $request->bedrooms);
        }

        $sortBy = $request->get('sort', 'area_asc');
        if ($sortBy === 'area_asc') {
            $query->orderBy('area_sqm', 'asc');
        } elseif ($sortBy === 'area_desc') {
            $query->orderBy('area_sqm', 'desc');
        }

        $apartments = $query->get();

        return view('apartments.index', compact('apartments'));
    }

    public function show(Apartment $apartment): View
    {
        return view('apartments.show', compact('apartment'));
    }
}
