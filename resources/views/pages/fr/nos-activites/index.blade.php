@extends('layouts.site')

@section('title', 'Nos activités — Conception, recettes, distribution, promotion — FAR')
@section('meta_description', 'De la conception de marque à la distribution, en passant par le développement de recettes et la promotion événementielle : découvrez le savoir-faire de FAR.')

@section('content')
<div class="wrap">

    <section class="section">
        <h1 class="page-title">Ce que nous faisons</h1>
        <p class="lede section-outro">Quatre piliers, une même maîtrise du produit d'apéritif : de l'idée à la marque, de la recette à la distribution.</p>
    </section>

    <section class="section">
        <div class="card-grid">
            <a class="card" href="{{ route_ts('activities.show', ['locale' => app()->getLocale(), 'slug' => 'creation-de-marques']) }}">
                <x-media name="pilier-creation" shape="square" alt="" class="card__media" />
                <h3>Création de marques</h3>
                <p>Une marque, de l'idée au produit fini.</p>
            </a>
            <a class="card" href="{{ route_ts('activities.show', ['locale' => app()->getLocale(), 'slug' => 'recettes-et-produits']) }}">
                <x-media name="pilier-recettes" shape="square" alt="" class="card__media" />
                <h3>Recettes et produits</h3>
                <p>Des recettes pensées pour durer.</p>
            </a>
            <a class="card" href="{{ route_ts('activities.show', ['locale' => app()->getLocale(), 'slug' => 'low-et-sans-alcool']) }}">
                <x-media name="pilier-low" shape="square" alt="" class="card__media" />
                <h3>Low et sans alcool</h3>
                <p>Réussir le virage du low et du sans alcool.</p>
            </a>
            <a class="card" href="{{ route_ts('activities.show', ['locale' => app()->getLocale(), 'slug' => 'distribution-et-promotion']) }}">
                <x-media name="pilier-distribution" shape="square" alt="" class="card__media" />
                <h3>Distribution et promotion</h3>
                <p>Faire vivre une marque, au-delà du produit.</p>
            </a>
        </div>
    </section>

</div>
@endsection
