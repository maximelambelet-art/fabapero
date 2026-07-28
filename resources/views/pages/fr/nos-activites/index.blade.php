@extends('layouts.site')

@section('title', 'Nos activités — Conception, recettes, distribution, promotion — FAR')
@section('meta_description', 'De la conception de marque à la distribution, en passant par le développement de recettes et la promotion événementielle : découvrez le savoir-faire de FAR.')

@section('content')
<div class="wrap">
    <h1>Ce que nous faisons</h1>
    <p class="lede">Quatre piliers, une même maîtrise du produit d'apéritif : de l'idée à la marque, de la recette à la distribution.</p>

    <div class="activity-grid">
        <a class="activity-card" href="{{ route_ts('activities.show', ['locale' => app()->getLocale(), 'slug' => 'creation-de-marques']) }}">
            <h3>Création de marques</h3>
            <p>Une marque, de l'idée au produit fini.</p>
        </a>
        <a class="activity-card" href="{{ route_ts('activities.show', ['locale' => app()->getLocale(), 'slug' => 'recettes-et-produits']) }}">
            <h3>Recettes et produits</h3>
            <p>Des recettes pensées pour durer.</p>
        </a>
        <a class="activity-card" href="{{ route_ts('activities.show', ['locale' => app()->getLocale(), 'slug' => 'low-et-sans-alcool']) }}">
            <h3>Low et sans alcool</h3>
            <p>Réussir le virage du low et du sans alcool.</p>
        </a>
        <a class="activity-card" href="{{ route_ts('activities.show', ['locale' => app()->getLocale(), 'slug' => 'distribution-et-promotion']) }}">
            <h3>Distribution et promotion</h3>
            <p>Faire vivre une marque, au-delà du produit.</p>
        </a>
    </div>
</div>
@endsection
