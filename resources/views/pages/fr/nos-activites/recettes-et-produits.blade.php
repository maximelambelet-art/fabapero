@extends('layouts.site')

@section('title', 'Création et optimisation de recettes — FAR')
@section('meta_description', 'Recettes créées, testées et optimisées avec un vrai savoir-faire technique, du concept à la production.')

@section('content')
<div class="wrap">

    <section class="section">
        <p class="section-label">Nos activités</p>
        <h1 class="page-title">Des recettes pensées pour durer</h1>
    </section>

    <section class="section prose">
        <p>Une bonne recette ne se limite pas au goût : elle doit aussi tenir la distance, de la première cuve au millième litre produit. Je me forme continuellement aux techniques et technologies les plus récentes pour créer et optimiser des recettes qui répondent à cette double exigence — le plaisir, et la fiabilité de la production.</p>
    </section>

    <x-media name="recettes-et-produits" shape="wide" alt="Mise au point d'une recette en atelier" class="section" />

    <section class="section">
        <div class="callout">
            <p>Une recette à créer ou à faire évoluer ?</p>
            <a class="button" href="{{ route_ts('contact', ['locale' => app()->getLocale()]) }}">Parlons-en</a>
        </div>
    </section>

</div>
@endsection
