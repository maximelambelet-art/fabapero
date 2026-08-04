@extends('layouts.site')

@section('title', __('pages.contact.title'))
@section('meta_description', __('pages.contact.meta'))

@section('content')
<div class="wrap">

    <section class="section">
        <h1 class="page-title">{{ __('pages.contact.h1') }}</h1>
        <p class="lede section-outro">{{ __('pages.contact.lede') }}</p>
    </section>

    <section class="section">
        @if (session('contactSent'))
            <p class="form-success">{{ __('pages.contact.sent') }}</p>
        @endif

        <form class="form" method="POST" action="{{ route_ts('contact.store', ['locale' => app()->getLocale()]) }}" novalidate>
            @csrf

            <div class="form-field honeypot-field" aria-hidden="true">
                <label for="website">{{ __('pages.contact.honeypot') }}</label>
                <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
            </div>

            <div class="form-field">
                <label for="name">{{ __('pages.contact.name') }}</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" autocomplete="name" required>
                @error('name') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-field">
                <label for="email">{{ __('pages.contact.email') }}</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" autocomplete="email" required>
                @error('email') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-field">
                <label for="message">{{ __('pages.contact.message') }}</label>
                <textarea id="message" name="message" rows="7" required>{{ old('message') }}</textarea>
                @error('message') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div>
                <button type="submit" class="button">{{ __('pages.contact.submit') }}</button>
            </div>
        </form>
    </section>

    <section class="section">
        <div class="contact-details">
            <div>
                <p class="site-footer__heading">{{ __('pages.contact.details_email') }}</p>
                <a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a>
            </div>
            <div>
                <p class="site-footer__heading">{{ __('pages.contact.details_phone') }}</p>
                <a href="tel:{{ str_replace(' ', '', config('site.phone')) }}">{{ config('site.phone') }}</a>
            </div>
            <div>
                <p class="site-footer__heading">{{ __('pages.contact.details_address') }}</p>
                <p>
                    {{ config('site.address.street') }}<br>
                    {{ config('site.address.postal_code') }} {{ config('site.address.city') }}
                </p>
            </div>
        </div>
    </section>

</div>
@endsection
