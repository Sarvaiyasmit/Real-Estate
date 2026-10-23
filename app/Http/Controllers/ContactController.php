<?php

namespace App\Http\Controllers;

use App\Models\Enquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('contact');
    }

    public function submit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'interest' => ['nullable', 'in:buying,selling,advisory,site_visit'],
            'message' => ['required', 'string', 'max:3000'],
            'unit' => ['nullable', 'string', 'max:30'],
        ]);

        Enquiry::create($validated);

        return redirect()->route('contact')
            ->with('success', 'Thank you for your enquiry. We will be in touch within one business day.');
    }
}
