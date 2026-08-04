@extends('layouts.site')

@section('title', "Fabriques d'Apéro Réunies — Créateurs de marques et solutions apéritif en Suisse")
@section('meta_description', "FAR imagine, développe et distribue des marques et des solutions autour de l'apéritif en Suisse. Recettes, low et sans alcool, distribution, promotion événementielle.")

@push('head')
<script type="application/ld+json">
{!! json_encode([
    '@@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => config('site.name'),
    'legalName' => config('site.legal_name'),
    'email' => config('site.email'),
    'telephone' => config('site.phone'),
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => config('site.address.street'),
        'postalCode' => config('site.address.postal_code'),
        'addressLocality' => config('site.address.city'),
        'addressCountry' => config('site.address.country'),
    ],
    'url' => route_ts('home', ['locale' => app()->getLocale()]),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

@section('content')
<div class="wrap">

    <section class="hero section">
        <h1>Fabriques d'Apéro Réunies</h1>
        <p class="hero__kicker">Une maison suisse qui conçoit des marques d'apéritif, de la recette à la machine qui la fabrique.</p>
        <p class="lede">Fabriques d'Apéro Réunies est une maison Suisse indépendante qui imagine, développe et met en mouvement des produits, des marques et des solutions autour de l'apéritif. FAR réunit au sein d'une même structure une approche créative, une capacité de développement produit, une activité de distribution et un savoir-faire en promotion et en solutions événementielles.</p>
    </section>

    <x-media name="accueil-bandeau" shape="wide" alt="Atelier de Fabriques d'Apéro Réunies" class="section" />

    <section class="section">
        <p class="section-label">Ce que nous faisons</p>
        <div class="pillars">
            <div class="pillar">
                <x-pillar-icon name="creer" />
                <h3>Créer</h3>
                <p>Nous imaginons et concevons des marques et des produits d'apéritif, de l'idée jusqu'au concept prêt à produire.</p>
            </div>
            <div class="pillar">
                <x-pillar-icon name="developper" />
                <h3>Développer</h3>
                <p>Nous créons et optimisons des recettes, de la première cuve à la production en série, avec une expertise particulière pour accompagner la transition vers le low et le sans alcool.</p>
            </div>
            <div class="pillar">
                <x-pillar-icon name="distribuer" />
                <h3>Distribuer</h3>
                <p>Nous mettons nos marques, et celles de nos partenaires, en mouvement grâce à nos propres canaux de distribution.</p>
            </div>
            <div class="pillar">
                <x-pillar-icon name="promouvoir" />
                <h3>Promouvoir</h3>
                <p>Nous concevons des solutions de promotion et des activations événementielles qui font vivre une marque sur le terrain.</p>
            </div>
        </div>
    </section>

    <section class="section statement">
        <p class="statement__text">De la première limonaderie artisanale du canton de Neuchâtel à la création de cocktails sans alcool qui ont conquis la Suisse : FAR est né d'une conviction simple, et d'un savoir-faire acquis sur le terrain, de la recette jusqu'à la machine qui la produit.</p>
        <a class="link-arrow" href="{{ route_ts('about', ['locale' => app()->getLocale()]) }}">Qui sommes-nous</a>
    </section>

    <section class="section">
        <div class="callout">
            <p>Brasseur, vigneron, ou porteur d'un autre projet de boisson ? Découvrez comment FAR peut vous accompagner.</p>
            <a class="button" href="{{ route_ts('services', ['locale' => app()->getLocale()]) }}">Nos services</a>
        </div>
    </section>

    @if (count($recentPosts) > 0)
        <section class="section">
            <p class="section-label">Actualités</p>
            <div class="post-list">
                @foreach ($recentPosts as $post)
                    <article class="post-list__item">
                        <p class="post-meta">{{ $post->date->translatedFormat('d F Y') }}</p>
                        <h3><a href="{{ route_ts('news.show', ['locale' => app()->getLocale(), 'slug' => $post->slug]) }}">{{ $post->title }}</a></h3>
                        <p>{{ $post->excerpt }}</p>
                    </article>
                @endforeach
            </div>
            <p class="section-outro">
                <a class="link-arrow" href="{{ route_ts('news.index', ['locale' => app()->getLocale()]) }}">Toutes les actualités</a>
            </p>
        </section>
    @endif

</div>
@endsection
