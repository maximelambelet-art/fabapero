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
    @if ($currentRouteName)
        <link rel="canonical" href="{{ route_ts($currentRouteName, $currentParams) }}">
        @foreach (config('site.active_locales') as $altLocale)
            <link rel="alternate" hreflang="{{ $altLocale }}" href="{{ route_ts($currentRouteName, array_merge($currentParams, ['locale' => $altLocale])) }}">
        @endforeach
        <link rel="alternate" hreflang="x-default" href="{{ route_ts($currentRouteName, array_merge($currentParams, ['locale' => config('site.default_locale')])) }}">
    @endif
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    @stack('head')
</head>
<body>
    @include('partials.nav')
    <main>
        @yield('content')
    </main>
    @include('partials.footer')
</body>
</html>
