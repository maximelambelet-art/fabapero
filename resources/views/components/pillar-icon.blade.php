@props(['name'])

{{-- Drawn to sit next to the FAR glass mark: same drinks vocabulary,
     simple closed shapes, no hairlines that would look unrelated to it. --}}
<svg {{ $attributes->merge(['class' => 'pillar__icon']) }} viewBox="0 0 24 24" fill="none"
     stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"
     aria-hidden="true" focusable="false">
    @switch($name)
        @case('creer')
            {{-- A bottle taking shape, with a spark: the idea before the product --}}
            <path d="M10 2.8h4v3.4l2 2.9c.26.38.4.83.4 1.29V19a2 2 0 0 1-2 2H9.6a2 2 0 0 1-2-2v-8.6c0-.46.14-.91.4-1.29l2-2.9V2.8Z"/>
            <path d="M7.6 12.4h8.8"/>
            <path d="M19.6 3.2l.62 1.46 1.46.62-1.46.62-.62 1.46-.62-1.46L17.52 5.3l1.46-.62.62-1.46Z"/>
            @break

        @case('developper')
            {{-- A flask: the recipe, tested and retested --}}
            <path d="M9.4 2.9v5.5L5 17.2a2 2 0 0 0 1.76 2.95h10.48A2 2 0 0 0 19 17.2l-4.4-8.8V2.9"/>
            <path d="M8.2 2.9h7.6"/>
            <path d="M6.9 14.6h10.2"/>
            @break

        @case('distribuer')
            {{-- A crate: the brand leaving the workshop --}}
            <path d="M2.9 7.9h18.2v10.6a2 2 0 0 1-2 2H4.9a2 2 0 0 1-2-2V7.9Z"/>
            <path d="M2.9 7.9 5 3.6h14l2.1 4.3"/>
            <path d="M12 3.6v4.3"/>
            <path d="M9.6 12.2h4.8"/>
            @break

        @case('promouvoir')
            {{-- Two glasses raised: the product discovered, tasted, adopted --}}
            <path d="M3.2 3.6h7.4l-3.7 6.6-3.7-6.6Z"/>
            <path d="M6.9 10.2v7.2"/>
            <path d="M4.5 17.4h4.8"/>
            <path d="M13.4 3.6h7.4l-3.7 6.6-3.7-6.6Z"/>
            <path d="M17.1 10.2v7.2"/>
            <path d="M14.7 17.4h4.8"/>
            @break
    @endswitch
</svg>
