@extends('layouts.site')

@section('title', 'Actualités — Fabriques d\'Apéro Réunies')
@section('meta_description', 'Tendances, recettes et coulisses de FAR.')

@section('content')
<div class="wrap">

    <section class="section">
        <h1 class="page-title">Actualités</h1>
    </section>

    <section class="section">
        <div class="post-list">
            @forelse ($posts as $post)
                <article class="post-list__item">
                    <p class="post-meta">{{ $post->date->translatedFormat('d F Y') }}</p>
                    <h2><a href="{{ route_ts('news.show', ['locale' => app()->getLocale(), 'slug' => $post->slug]) }}">{{ $post->title }}</a></h2>
                    <p>{{ $post->excerpt }}</p>
                </article>
            @empty
                <p>Les premiers articles arrivent bientôt.</p>
            @endforelse
        </div>
    </section>

</div>
@endsection
