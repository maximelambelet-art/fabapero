@extends('layouts.site')

@section('title', __('pages.news.title'))
@section('meta_description', __('pages.news.meta'))

@section('content')
<div class="wrap">

    <section class="section">
        <h1 class="page-title">{{ __('pages.news.h1') }}</h1>
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
                <p>{{ __('pages.news.empty') }}</p>
            @endforelse
        </div>
    </section>

</div>
@endsection
