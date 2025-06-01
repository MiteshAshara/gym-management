<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class PublicInquiryController extends Controller
{
    /**
     * Show the public inquiry form.
     */
    public function showForm()
    {
        return view('public.inquiry-form');
    }

    /**
     * Store a new inquiry from public form.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:10|regex:/^\d{10}$/',
            'gender' => 'required|in:male,female',
            'age' => 'required|integer|min:8|max:99',
            'height_in_inches' => 'required|integer|min:26|max:1096',
            'weight' => 'required|integer|min:30|max:1500',
        ]);

        // Store the inquiry with 'pending' status by default
        Inquiry::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'gender' => $request->gender,
            'age' => $request->age,
            'height_in_inches' => $request->height_in_inches,
            'weight' => $request->weight,
            'address' => $request->address,
            'notes' => $request->notes,
            'status' => 'pending',
        ]);

        return redirect()->route('public.inquiry.success');
    }

    /**
     * Show success page after form submission.
     */
    public function success()
    {
        return view('public.inquiry-success');
    }

    /**
     * Generate and display QR code for the inquiry form.
     */
    public function generateQrCode()
    {
        $url = route('public.inquiry.form');
        return view('public.inquiry-qr', compact('url'));
    }
}
