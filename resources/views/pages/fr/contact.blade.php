@extends('layouts.site')

@section('title', 'Contact — Fabriques d\'Apéro Réunies')
@section('meta_description', 'Contactez FAR pour parler de votre projet de marque, de recette ou de distribution.')

@section('content')
<div class="wrap prose">
    <h1>Contact</h1>
    <p>Une idée, un produit, un projet de virage vers le low ou le sans alcool ? Parlons-en.</p>

    @if (session('contactSent'))
        <p class="form-success">Merci, votre message a bien été envoyé. Nous vous répondrons rapidement.</p>
    @endif

    <form method="POST" action="{{ route_ts('contact.store', ['locale' => app()->getLocale()]) }}" novalidate>
        @csrf

        <div class="form-field honeypot-field" aria-hidden="true">
            <label for="website">Ne pas remplir ce champ</label>
            <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
        </div>

        <div class="form-field">
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            @error('name') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-field">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <div class="form-field">
            <label for="message">Message</label>
            <textarea id="message" name="message" rows="6" required>{{ old('message') }}</textarea>
            @error('message') <span class="form-error">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="button">Envoyer</button>
    </form>

    <p>{{ config('site.email') }} · {{ config('site.phone') }}</p>
</div>
@endsection
