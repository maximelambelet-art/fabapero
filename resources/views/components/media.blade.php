@props([
    'name',
    'alt',
    'shape' => 'wide',
])

@php
    // Renders only once a real file is dropped in public/img/site. While the
    // slot is empty it outputs nothing at all — no grey placeholder standing
    // in for content that does not exist yet.
    $found = site_image($name);
@endphp

@if ($found)
    <figure {{ $attributes->merge(['class' => 'media media--'.$shape]) }}>
        <img src="{{ asset($found) }}" alt="{{ $alt }}" loading="lazy" decoding="async">
    </figure>
@endif
