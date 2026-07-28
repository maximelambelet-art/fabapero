@php
    $locale = app()->getLocale();
@endphp
<footer class="site-footer">
    <div class="wrap site-footer__inner">
        <div class="site-footer__contact">
            <a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a>
            <a href="tel:{{ str_replace(' ', '', config('site.phone')) }}">{{ config('site.phone') }}</a>
        </div>

        <nav class="site-footer__legal">
            <a href="{{ route_ts('legal', ['locale' => $locale]) }}">{{ __('nav.legal') }}</a>
            <a href="{{ route_ts('privacy', ['locale' => $locale]) }}">{{ __('nav.privacy') }}</a>
        </nav>

        <p class="site-footer__copyright">&copy; {{ now()->year }} {{ config('site.legal_name') }}</p>
    </div>
</footer>
