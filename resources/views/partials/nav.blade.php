@php
    $locale = app()->getLocale();
@endphp
<header class="site-header">
    <div class="wrap site-header__inner">
        <a class="site-header__brand" href="{{ route_ts('home', ['locale' => $locale]) }}">{{ config('site.name') }}</a>

        <input type="checkbox" id="nav-toggle" class="nav-toggle">
        <label for="nav-toggle" class="nav-toggle__label" aria-label="Menu">☰</label>

        <nav class="site-nav">
            <a href="{{ route_ts('home', ['locale' => $locale]) }}" @class(['is-active' => request()->routeIs('home')])>{{ __('nav.home') }}</a>
            <a href="{{ route_ts('about', ['locale' => $locale]) }}" @class(['is-active' => request()->routeIs('about')])>{{ __('nav.about') }}</a>
            <a href="{{ route_ts('activities.index', ['locale' => $locale]) }}" @class(['is-active' => request()->routeIs('activities.*')])>{{ __('nav.activities') }}</a>
            <a href="{{ route_ts('services', ['locale' => $locale]) }}" @class(['is-active' => request()->routeIs('services')])>{{ __('nav.services') }}</a>
            <a href="{{ route_ts('news.index', ['locale' => $locale]) }}" @class(['is-active' => request()->routeIs('news.*')])>{{ __('nav.news') }}</a>
            <a href="{{ route_ts('contact', ['locale' => $locale]) }}" @class(['site-nav__cta' => true, 'is-active' => request()->routeIs('contact')])>{{ __('nav.contact') }}</a>
        </nav>
    </div>
</header>
