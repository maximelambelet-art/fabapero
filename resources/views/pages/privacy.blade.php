@extends('layouts.site')

@section('title', __('pages.privacy.title'))
@section('meta_description', __('pages.privacy.meta'))

@section('content')
<div class="wrap">

    <section class="section">
        <h1 class="page-title">{{ __('pages.privacy.h1') }}</h1>
    </section>

    <section class="section prose">
        <p>{!! __('pages.privacy.p1', ['email' => '<a href="mailto:'.config('site.email').'">'.config('site.email').'</a>']) !!}</p>
        <p>{{ __('pages.privacy.p2') }}</p>
    </section>

</div>
@endsection
