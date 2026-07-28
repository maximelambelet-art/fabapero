@extends('layouts.site')

@section('title', $post->title.' — Fabriques d\'Apéro Réunies')
@section('meta_description', $post->metaDescription)

@section('content')
<div class="wrap prose">
    <p class="post-meta">{{ $post->date->translatedFormat('d F Y') }}</p>
    <h1>{{ $post->title }}</h1>

    {!! $post->bodyHtml !!}

    <p><a href="{{ route_ts('news.index', ['locale' => app()->getLocale()]) }}">← Toutes les actualités</a></p>
</div>
@endsection
