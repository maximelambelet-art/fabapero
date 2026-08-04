@extends('layouts.site')

@section('title', 'Le low et le sans alcool, sans compromis — FAR')
@section('meta_description', 'FAR accompagne brasseurs, vignerons et producteurs de boissons dans la création de recettes low et sans alcool qui préservent le goût.')

@section('content')
<div class="wrap">

    <section class="section">
        <p class="section-label">Nos activités</p>
        <h1 class="page-title">Réussir le virage du low et du sans alcool</h1>
    </section>

    <section class="section prose">
        <p>Le marché du low et du sans alcool devrait croître de 37% d'ici 2027 — une vraie opportunité, mais un vrai défi technique : comment réduire ou retirer l'alcool sans perdre le caractère du produit ? C'est une question que j'ai explorée moi-même en développant Kobiji, une marque de cocktails sans alcool à base de produits désalcoolisés qui conservent le goût des spiritueux. Cette expertise est aujourd'hui au service des brasseurs, des vignerons, et plus largement de tout producteur de boisson qui veut réussir ce virage sans sacrifier le goût.</p>
    </section>

    <x-media name="low-et-sans-alcool" shape="wide" alt="Cocktails sans alcool développés par Fabriques d'Apéro Réunies" class="section" />

    <section class="section">
        <div class="callout">
            <p>Une gamme low ou sans alcool à mettre au point ?</p>
            <a class="button" href="{{ route_ts('contact', ['locale' => app()->getLocale()]) }}">Parlons-en</a>
        </div>
    </section>

</div>
@endsection
