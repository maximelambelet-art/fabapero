@extends('layouts.site')

@section('title', 'Vous êtes brasseur ou vigneron ? Nos services — FAR')
@section('meta_description', 'FAR accompagne brasseurs, vignerons et producteurs de boissons dans la création de recettes et concepts low et sans alcool. Contactez-nous.')

@section('content')
<div class="wrap prose">
    <h1>Un partenaire pour votre marque</h1>

    <p><strong>Vous êtes brasseur ou vigneron ?</strong> Le marché du low et sans alcool devrait croître de 37% d'ici 2027 — une opportunité concrète que nous vous aidons à saisir, en créant pour vous des recettes et des concepts complets, pensés pour préserver le goût et le caractère de votre production.</p>

    <p>Plus largement, tout entrepreneur, toute marque ou tout producteur de boisson qui souhaite créer, faire évoluer ou distribuer un produit peut compter sur le même savoir-faire — de la recette à la mise sur le marché.</p>

    <p><a class="button" href="{{ route_ts('contact', ['locale' => app()->getLocale()]) }}">Parlons de votre projet</a></p>
</div>
@endsection
