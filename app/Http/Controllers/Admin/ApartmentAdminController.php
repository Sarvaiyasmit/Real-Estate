<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ApartmentAdminController extends Controller
{
    public function index(): View
    {
        $apartments = Apartment::latest()->paginate(15);

        return view('admin.apartments.index', compact('apartments'));
    }

    public function create(): View
    {
        return view('admin.apartments.form', ['apartment' => new Apartment]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'unit_number' => ['required', 'string', 'max:20'],
            'typology' => ['required', 'in:ground_garden,ground_basement,penthouse_duplex'],
            'block' => ['required', 'in:A,B,C'],
            'floor' => ['required', 'integer', 'min:0', 'max:30'],
            'bedrooms' => ['required', 'integer', 'min:1', 'max:10'],
            'area_sqm' => ['required', 'numeric', 'min:20'],
            'terrace_sqm' => ['nullable', 'numeric', 'min:0'],
            'orientation' => ['nullable', 'string', 'max:30'],
            'status' => ['required', 'in:available,reserved,sold'],
            'completion_date' => ['nullable', 'date'],
            'image' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        Apartment::create($validated);

        return redirect()->route('admin.apartments.index')
            ->with('success', 'Apartment created successfully.');
    }

    public function edit(Apartment $apartment): View
    {
        return view('admin.apartments.form', compact('apartment'));
    }

    public function update(Request $request, Apartment $apartment): RedirectResponse
    {
        $validated = $request->validate([
            'unit_number' => ['required', 'string', 'max:20'],
            'typology' => ['required', 'in:ground_garden,ground_basement,penthouse_duplex'],
            'block' => ['required', 'in:A,B,C'],
            'floor' => ['required', 'integer', 'min:0', 'max:30'],
            'bedrooms' => ['required', 'integer', 'min:1', 'max:10'],
            'area_sqm' => ['required', 'numeric', 'min:20'],
            'terrace_sqm' => ['nullable', 'numeric', 'min:0'],
            'orientation' => ['nullable', 'string', 'max:30'],
            'status' => ['required', 'in:available,reserved,sold'],
            'completion_date' => ['nullable', 'date'],
            'image' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);

        $apartment->update($validated);

        return redirect()->route('admin.apartments.index')
            ->with('success', 'Apartment updated successfully.');
    }

    public function destroy(Apartment $apartment): RedirectResponse
    {
        $apartment->delete();

        return redirect()->route('admin.apartments.index')
            ->with('success', 'Apartment deleted successfully.');
    }
}
