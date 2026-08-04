@php
    $locale = app()->getLocale();
@endphp
<footer class="site-footer">
    <div class="wrap">
        <div class="site-footer__inner">
            <div class="site-footer__col">
                <a class="brand" href="{{ route_ts('home', ['locale' => $locale]) }}">
                    <img class="brand__mark" src="{{ asset('img/logo-far.png') }}" alt="" width="200" height="200">
                    <span class="brand__name">Fabriques d'Apéro Réunies</span>
                </a>
            </div>

            <div class="site-footer__col">
                <p class="site-footer__heading">{{ __("pages.footer_contact") }}</p>
                <a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a>
                <a href="tel:{{ str_replace(' ', '', config('site.phone')) }}">{{ config('site.phone') }}</a>
            </div>

            <div class="site-footer__col">
                <p class="site-footer__heading">{{ __("pages.footer_address") }}</p>
                <p>
                    {{ config('site.address.street') }}<br>
                    {{ config('site.address.postal_code') }} {{ config('site.address.city') }}<br>
                    {{ __('pages.country') }}
                </p>
            </div>

            <div class="site-footer__col">
                <p class="site-footer__heading">{{ __("pages.footer_info") }}</p>
                <a href="{{ route_ts('legal', ['locale' => $locale]) }}">{{ __('nav.legal') }}</a>
                <a href="{{ route_ts('privacy', ['locale' => $locale]) }}">{{ __('nav.privacy') }}</a>
            </div>
        </div>

        <p class="site-footer__bottom">&copy; {{ now()->year }} {{ config('site.legal_name') }}</p>
    </div>
</footer>
