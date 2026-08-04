@extends('layouts.site')

@section('title', 'Contact — Fabriques d\'Apéro Réunies')
@section('meta_description', 'Contactez FAR pour parler de votre projet de marque, de recette ou de distribution.')

@section('content')
<div class="wrap">

    <section class="section">
        <h1 class="page-title">Contact</h1>
        <p class="lede section-outro">Une idée, un produit, un projet de virage vers le low ou le sans alcool ? Parlons-en.</p>
    </section>

    <section class="section">
        @if (session('contactSent'))
            <p class="form-success">Merci, votre message a bien été envoyé. Nous vous répondrons rapidement.</p>
        @endif

        <form class="form" method="POST" action="{{ route_ts('contact.store', ['locale' => app()->getLocale()]) }}" novalidate>
            @csrf

            <div class="form-field honeypot-field" aria-hidden="true">
                <label for="website">Ne pas remplir ce champ</label>
                <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
            </div>

            <div class="form-field">
                <label for="name">Nom</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" autocomplete="name" required>
                @error('name') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-field">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" autocomplete="email" required>
                @error('email') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-field">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="7" required>{{ old('message') }}</textarea>
                @error('message') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div>
                <button type="submit" class="button">Envoyer</button>
            </div>
        </form>
    </section>

    <section class="section">
        <div class="contact-details">
            <div>
                <p class="site-footer__heading">E-mail</p>
                <a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a>
            </div>
            <div>
                <p class="site-footer__heading">Téléphone</p>
                <a href="tel:{{ str_replace(' ', '', config('site.phone')) }}">{{ config('site.phone') }}</a>
            </div>
            <div>
                <p class="site-footer__heading">Adresse</p>
                <p>
                    {{ config('site.address.street') }}<br>
                    {{ config('site.address.postal_code') }} {{ config('site.address.city') }}
                </p>
            </div>
        </div>
    </section>

</div>
@endsection
