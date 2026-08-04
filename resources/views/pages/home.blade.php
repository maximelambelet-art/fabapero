@extends('layouts.site')

@section('title', __('pages.home.title'))
@section('meta_description', __('pages.home.meta'))

@push('head')
<script type="application/ld+json">
{!! json_encode([
    '@@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => config('site.name'),
    'legalName' => config('site.legal_name'),
    'email' => config('site.email'),
    'telephone' => config('site.phone'),
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => config('site.address.street'),
        'postalCode' => config('site.address.postal_code'),
        'addressLocality' => config('site.address.city'),
        'addressCountry' => config('site.address.country'),
    ],
    'url' => route_ts('home', ['locale' => app()->getLocale()]),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

@section('content')
<div class="wrap">

    <section class="hero section">
        <h1>{{ __('pages.home.h1') }}</h1>
        <p class="hero__kicker">{{ __('pages.home.kicker') }}</p>
        <p class="lede">{{ __('pages.home.lede') }}</p>
    </section>

    <x-media name="accueil-bandeau" shape="wide" :alt="__('pages.home.hero_image_alt')" class="section" />

    <section class="section">
        <p class="section-label">{{ __('pages.home.pillars_label') }}</p>
        <div class="pillars">
            @foreach (['creer', 'developper', 'distribuer', 'promouvoir'] as $pillar)
                <div class="pillar">
                    <x-pillar-icon :name="$pillar" />
                    <h3>{{ __('pages.pillars.'.$pillar.'.title') }}</h3>
                    <p>{{ __('pages.pillars.'.$pillar.'.text') }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="section statement">
        <p class="statement__text">{{ __('pages.home.statement') }}</p>
        <a class="link-arrow" href="{{ route_ts('about', ['locale' => app()->getLocale()]) }}">{{ __('nav.about') }}</a>
    </section>

    <section class="section">
        <div class="callout">
            <p>{{ __('pages.home.services_teaser') }}</p>
            <a class="button" href="{{ route_ts('services', ['locale' => app()->getLocale()]) }}">{{ __('pages.home.services_cta') }}</a>
        </div>
    </section>

    @if (count($recentPosts) > 0)
        <section class="section">
            <p class="section-label">{{ __('pages.home.news_label') }}</p>
            <div class="post-list">
                @foreach ($recentPosts as $post)
                    <article class="post-list__item">
                        <p class="post-meta">{{ $post->date->translatedFormat('d F Y') }}</p>
                        <h3><a href="{{ route_ts('news.show', ['locale' => app()->getLocale(), 'slug' => $post->slug]) }}">{{ $post->title }}</a></h3>
                        <p>{{ $post->excerpt }}</p>
                    </article>
                @endforeach
            </div>
            <p class="section-outro">
                <a class="link-arrow" href="{{ route_ts('news.index', ['locale' => app()->getLocale()]) }}">{{ __('pages.home.news_all') }}</a>
            </p>
        </section>
    @endif

</div>
@endsection
