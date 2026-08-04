@php
    $locales = switchable_locales();
@endphp

@if (count($locales) > 1)
    <div class="lang-switch" role="group" aria-label="{{ __('pages.choose_language') }}">
        @foreach ($locales as $locale)
            @if ($locale === app()->getLocale())
                <span class="lang-switch__item is-current" aria-current="true">{{ strtoupper($locale) }}</span>
            @else
                <a class="lang-switch__item" href="{{ locale_url($locale) }}" hreflang="{{ $locale }}"
                   lang="{{ $locale }}">{{ strtoupper($locale) }}</a>
            @endif
        @endforeach
    </div>
@endif
