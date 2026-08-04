@extends('layouts.site')

@section('title', __('pages.activities.title'))
@section('meta_description', __('pages.activities.meta'))

@php
    $slots = [
        'creation-de-marques' => 'pilier-creation',
        'recettes-et-produits' => 'pilier-recettes',
        'low-et-sans-alcool' => 'pilier-low',
        'distribution-et-promotion' => 'pilier-distribution',
    ];
@endphp

@section('content')
<div class="wrap">

    <section class="section">
        <h1 class="page-title">{{ __('pages.activities.h1') }}</h1>
        <p class="lede section-outro">{{ __('pages.activities.lede') }}</p>
    </section>

    <section class="section">
        <div class="card-grid">
            @foreach ($slots as $slug => $slot)
                <a class="card" href="{{ route_ts('activities.show', ['locale' => app()->getLocale(), 'slug' => $slug]) }}">
                    <x-media :name="$slot" shape="square" alt="" class="card__media" />
                    <h3>{{ __('pages.activities.cards.'.$slug.'.title') }}</h3>
                    <p>{{ __('pages.activities.cards.'.$slug.'.text') }}</p>
                </a>
            @endforeach
        </div>
    </section>

</div>
@endsection
