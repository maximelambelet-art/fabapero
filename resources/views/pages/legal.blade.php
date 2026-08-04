@extends('layouts.site')

@section('title', __('pages.legal.title'))
@section('meta_description', __('pages.legal.meta'))

@section('content')
<div class="wrap">

    <section class="section">
        <h1 class="page-title">{{ __('pages.legal.h1') }}</h1>
    </section>

    <section class="section prose">
        <dl class="legal-list">
            <div>
                <dt>{{ __('pages.legal.company') }}</dt>
                <dd>{{ config('site.legal_name') }}</dd>
            </div>
            <div>
                <dt>{{ __('pages.legal.form') }}</dt>
                <dd>{{ __('pages.legal.form_value') }}</dd>
            </div>
            <div>
                <dt>{{ __('pages.legal.office') }}</dt>
                <dd>{{ config('site.address.street') }}, {{ config('site.address.postal_code') }} {{ config('site.address.city') }}, {{ __('pages.country') }}</dd>
            </div>
            <div>
                <dt>{{ __('pages.legal.uid') }}</dt>
                <dd>CHE-335.684.044</dd>
            </div>
            <div>
                <dt>{{ __('pages.legal.register') }}</dt>
                <dd>{{ __('pages.legal.register_value') }}</dd>
            </div>
            <div>
                <dt>{{ __('pages.legal.representative') }}</dt>
                <dd>Maxime Lambelet</dd>
            </div>
            <div>
                <dt>{{ __('pages.legal.email') }}</dt>
                <dd><a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a></dd>
            </div>
            <div>
                <dt>{{ __('pages.legal.hosting') }}</dt>
                <dd>{{ __('pages.legal.hosting_value') }}</dd>
            </div>
        </dl>

        <p>{{ __('pages.legal.law') }}</p>
    </section>

</div>
@endsection
