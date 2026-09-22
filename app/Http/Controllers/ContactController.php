<?php

namespace App\Http\Controllers;

use App\Mail\ContactInquiryMail;
use App\Models\ContactInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController
{
    public function show()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        // DB mein save karo
        $inquiry = ContactInquiry::create([
            'name'    => $validated['name'],
            'email'   => $validated['email'],
            'phone'   => $validated['phone'] ?? null,
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status'  => 'new',
        ]);

        // Admin ko email bhejo
        try {
            $adminEmail = config('mail.from.address');
            Mail::to($adminEmail)->send(new ContactInquiryMail($inquiry));
        } catch (\Exception $e) {
            // Mail fail hone par bhi success redirect karo
            \Log::warning('Contact inquiry mail failed: ' . $e->getMessage());
        }

        return redirect()
            ->route('contact')
            ->with('success', '✅ Aapki inquiry successfully submit ho gayi! Hum jald hi aapse contact karenge.');
    }
}


