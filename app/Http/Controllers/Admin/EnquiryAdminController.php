<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EnquiryAdminController extends Controller
{
    public function index(): View
    {
        $enquiries = Enquiry::latest()->paginate(20);

        return view('admin.enquiries.index', compact('enquiries'));
    }

    public function show(Enquiry $enquiry): View
    {
        // Mark as read when opened
        if ($enquiry->status === 'new') {
            $enquiry->update(['status' => 'read']);
        }

        return view('admin.enquiries.show', compact('enquiry'));
    }

    public function markReplied(Enquiry $enquiry): RedirectResponse
    {
        $enquiry->update(['status' => 'replied']);

        return back()->with('success', 'Enquiry marked as replied.');
    }

    public function destroy(Enquiry $enquiry): RedirectResponse
    {
        $enquiry->delete();

        return redirect()->route('admin.enquiries.index')
            ->with('success', 'Enquiry deleted.');
    }
}
