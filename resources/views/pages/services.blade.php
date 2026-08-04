@extends('layouts.site')

@section('title', __('pages.services.title'))
@section('meta_description', __('pages.services.meta'))

@section('content')
<div class="wrap">

    <section class="section">
        <h1 class="page-title">{{ __('pages.services.h1') }}</h1>
    </section>

    <section class="section prose">
        <p><strong>{{ __('pages.services.p1_strong') }}</strong> {{ __('pages.services.p1') }}</p>
        <p>{{ __('pages.services.p2') }}</p>
    </section>

    <section class="section">
        <div class="callout">
            <p>{{ __('pages.services.cta_text') }}</p>
            <a class="button" href="{{ route_ts('contact', ['locale' => app()->getLocale()]) }}">{{ __('pages.services.cta_button') }}</a>
        </div>
    </section>

</div>
@endsection
