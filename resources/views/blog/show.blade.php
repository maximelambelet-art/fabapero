@extends('layouts.site')

@section('title', $post->title.' — Fabriques d\'Apéro Réunies')
@section('meta_description', $post->metaDescription)

@section('content')
<div class="wrap">

    <section class="section">
        <p class="post-meta">{{ $post->date->translatedFormat('d F Y') }}</p>
        <h1 class="page-title section-outro">{{ $post->title }}</h1>
    </section>

    <article class="section prose">
        {!! $post->bodyHtml !!}
    </article>

    <section class="section">
        <a class="link-arrow" href="{{ route_ts('news.index', ['locale' => app()->getLocale()]) }}">Toutes les actualités</a>
    </section>

</div>
@endsection
