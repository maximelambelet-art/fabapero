@extends('layouts.site')

@section('title', __('pages.about.title'))
@section('meta_description', __('pages.about.meta'))

@section('content')
<div class="wrap">

    <section class="section">
        <h1 class="page-title">{{ __('pages.about.h1') }}</h1>
    </section>

    <section @class(['section', 'feature', 'feature--with-media' => site_image('fondateur-portrait')])>
        <x-media name="fondateur-portrait" shape="portrait" :alt="__('pages.about.portrait_alt')" />

        <div class="prose">
            <p>{{ __('pages.about.p1') }}</p>
            <p>{{ __('pages.about.p2') }}</p>
            <x-media name="fabrication-1" shape="wide" :alt="__('pages.about.workshop_alt')" />
            <p>{{ __('pages.about.p3') }}</p>
        </div>
    </section>

    <section class="section">
        <div class="callout">
            <p>{{ __('pages.about.cta_text') }}</p>
            <a class="button" href="{{ route_ts('contact', ['locale' => app()->getLocale()]) }}">{{ __('pages.about.cta_button') }}</a>
        </div>
    </section>

</div>
@endsection
