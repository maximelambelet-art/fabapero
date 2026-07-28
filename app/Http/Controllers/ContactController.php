<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('pages.'.app()->getLocale().'.contact');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ], [
            'name.required' => 'Merci d\'indiquer votre nom.',
            'name.max' => 'Le nom ne doit pas dépasser 150 caractères.',
            'email.required' => 'Merci d\'indiquer votre e-mail.',
            'email.email' => 'Merci d\'indiquer une adresse e-mail valide.',
            'email.max' => 'L\'e-mail ne doit pas dépasser 255 caractères.',
            'message.required' => 'Merci de décrire votre projet en quelques mots.',
            'message.max' => 'Le message ne doit pas dépasser 5000 caractères.',
        ]);

        // Honeypot: hidden field a real visitor never fills. If it's set,
        // pretend success without sending, so bots don't learn to adapt.
        if ($request->filled('website')) {
            return redirect()->away(route_ts('contact', ['locale' => app()->getLocale()]))
                ->with('contactSent', true);
        }

        Mail::to(config('site.email'))->send(new ContactMessageMail(
            senderName: $validated['name'],
            senderEmail: $validated['email'],
            messageBody: $validated['message'],
        ));

        return redirect()->away(route_ts('contact', ['locale' => app()->getLocale()]))
            ->with('contactSent', true);
    }
}
