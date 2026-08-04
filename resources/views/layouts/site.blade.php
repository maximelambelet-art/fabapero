<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('site.name'))</title>
    <meta name="description" content="@yield('meta_description')">
    @php
        $currentRouteName = \Illuminate\Support\Facades\Route::currentRouteName();
        $currentParams = request()->route()?->parameters() ?? [];
    @endphp
    @if (in_array(app()->getLocale(), config('site.draft_locales'), true))
        <meta name="robots" content="noindex, nofollow">
    @endif

    @if ($currentRouteName)
        <link rel="canonical" href="{{ route_ts($currentRouteName, $currentParams) }}">
        @foreach (config('site.active_locales') as $altLocale)
            <link rel="alternate" hreflang="{{ $altLocale }}" href="{{ route_ts($currentRouteName, array_merge($currentParams, ['locale' => $altLocale])) }}">
        @endforeach
        <link rel="alternate" hreflang="x-default" href="{{ route_ts($currentRouteName, array_merge($currentParams, ['locale' => config('site.default_locale')])) }}">
    @endif

    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
    <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

    <meta property="og:site_name" content="{{ config('site.name') }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', config('site.name'))">
    <meta property="og:description" content="@yield('meta_description')">
    @if ($currentRouteName)
        <meta property="og:url" content="{{ route_ts($currentRouteName, $currentParams) }}">
    @endif

    @vite('resources/css/app.css')
    @stack('head')
</head>
<body>
    <a class="skip-link" href="#contenu">{{ __("pages.skip_link") }}</a>
    @include('partials.nav')
    <main id="contenu">
        @yield('content')
    </main>
    @include('partials.footer')
</body>
</html>
