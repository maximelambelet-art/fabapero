<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('pages.contact');
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:5000',
        ], __('contact'));

        // Not $request->validate(): that redirects back through a URL without
        // the trailing slash, and the resulting 301 consumes the flashed
        // errors, so the visitor would land on a blank form with no reason
        // given. Redirecting explicitly keeps the messages.
        if ($validator->fails()) {
            return $this->backToForm()
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        // Honeypot: hidden field a real visitor never fills. If it's set,
        // pretend success without sending, so bots don't learn to adapt.
        if ($request->filled('website')) {
            return $this->backToForm()->with('contactSent', true);
        }

        Mail::to(config('site.email'))->send(new ContactMessageMail(
            senderName: $validated['name'],
            senderEmail: $validated['email'],
            messageBody: $validated['message'],
        ));

        return $this->backToForm()->with('contactSent', true);
    }

    private function backToForm(): RedirectResponse
    {
        return redirect()->away(route_ts('contact', ['locale' => app()->getLocale()]));
    }
}
