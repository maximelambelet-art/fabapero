@extends('layouts.site')

@section('title', 'Actualités — Fabriques d\'Apéro Réunies')
@section('meta_description', 'Tendances, recettes et coulisses de FAR.')

@section('content')
<div class="wrap">
    <h1>Actualités</h1>

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
</div>
@endsection
