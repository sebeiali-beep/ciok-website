<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:30',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
        ]);

        $contact = Contact::create($validated);

        // Envoyer l'email à l'admin
        Mail::to('admin@ciok.tn')->send(new ContactMessage($contact));

        return redirect()->route('contact.show')
            ->with('success', 'Votre message a bien été envoyé ! Nous vous répondrons bientôt.');
    }
}