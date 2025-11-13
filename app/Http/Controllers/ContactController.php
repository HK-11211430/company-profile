<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactReceived;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subjek' => 'nullable|string|max:255',
            'pesan' => 'required|string',
        ]);

        $contact = Contact::create($data);

        // Send email to admin (uses mail.from.address by default)
        try {
            Mail::to(config('mail.from.address'))->send(new ContactReceived($contact));
        } catch (\Throwable $e) {
            // In dev, we don't fail the request if mail fails — log it
            logger()->error('Contact email failed: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Pesan Anda telah dikirim. Terima kasih!');
    }
}
