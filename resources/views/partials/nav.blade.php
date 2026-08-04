@php
    $locale = app()->getLocale();
@endphp
<header class="site-header">
    <div class="wrap site-header__inner">
        <a class="brand" href="{{ route_ts('home', ['locale' => $locale]) }}">
            <img class="brand__mark" src="{{ asset('img/logo-far.png') }}" alt="" width="200" height="200">
            <span class="brand__name">Fabriques d'Apéro Réunies</span>
        </a>

        <input type="checkbox" id="nav-toggle" class="nav-toggle">
        <label for="nav-toggle" class="nav-toggle__label" aria-label="{{ __('pages.menu') }}">
            <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                 stroke-width="1.8" stroke-linecap="round" aria-hidden="true">
                <path d="M4 7h16M4 12h16M4 17h16"/>
            </svg>
        </label>

        <nav class="site-nav" aria-label="{{ __('pages.main_nav') }}">
            <div class="site-nav__items">
                <a href="{{ route_ts('home', ['locale' => $locale]) }}" @class(['is-active' => request()->routeIs('home')])>{{ __('nav.home') }}</a>
                <a href="{{ route_ts('about', ['locale' => $locale]) }}" @class(['is-active' => request()->routeIs('about')])>{{ __('nav.about') }}</a>
                <a href="{{ route_ts('activities.index', ['locale' => $locale]) }}" @class(['is-active' => request()->routeIs('activities.*')])>{{ __('nav.activities') }}</a>
                <a href="{{ route_ts('services', ['locale' => $locale]) }}" @class(['is-active' => request()->routeIs('services')])>{{ __('nav.services') }}</a>
                <a href="{{ route_ts('news.index', ['locale' => $locale]) }}" @class(['is-active' => request()->routeIs('news.*')])>{{ __('nav.news') }}</a>
                <a href="{{ route_ts('contact', ['locale' => $locale]) }}" @class(['site-nav__cta' => true, 'is-active' => request()->routeIs('contact')])>{{ __('nav.contact') }}</a>
            </div>
        </nav>
    </div>
</header>
