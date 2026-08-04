@extends('layouts.site')

@section('title', __('pages.activity.'.$slug.'.title'))
@section('meta_description', __('pages.activity.'.$slug.'.meta'))

@section('content')
<div class="wrap">

    <section class="section">
        <p class="section-label">{{ __('pages.activities.label') }}</p>
        <h1 class="page-title">{{ __('pages.activity.'.$slug.'.h1') }}</h1>
    </section>

    <section class="section prose">
        <p>{{ __('pages.activity.'.$slug.'.body') }}</p>
    </section>

    <x-media :name="$slug" shape="wide" :alt="__('pages.activity.'.$slug.'.image_alt')" class="section" />

    <section class="section">
        <div class="callout">
            <p>{{ __('pages.activity.'.$slug.'.cta') }}</p>
            <a class="button" href="{{ route_ts('contact', ['locale' => app()->getLocale()]) }}">{{ __('pages.about.cta_button') }}</a>
        </div>
    </section>

</div>
@endsection
