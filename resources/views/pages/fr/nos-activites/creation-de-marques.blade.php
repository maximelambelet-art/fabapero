@extends('layouts.site')

@section('title', "Création de marques d'apéritif — FAR")
@section('meta_description', "FAR conçoit des marques et des produits d'apéritif, de l'idée à la mise sur le marché — recette, identité, production.")

@section('content')
<div class="wrap">

    <section class="section">
        <p class="section-label">Nos activités</p>
        <h1 class="page-title">Une marque, de l'idée au produit fini</h1>
    </section>

    <section class="section prose">
        <p>Créer une marque ne s'arrête pas à une bonne idée. Ça veut dire imaginer un concept, mettre au point la recette, choisir — ou parfois concevoir soi-même — les machines qui la produiront, et l'amener jusqu'au rayon ou au bar. C'est ce chemin complet que je maîtrise, de la première esquisse à la version testée et retestée, jusqu'au lancement. Plus de 10 produits ont déjà vu le jour de cette manière et trouvé leur place en Suisse.</p>
    </section>

    <x-media name="creation-de-marques" shape="wide" alt="Produit développé par Fabriques d'Apéro Réunies" class="section" />

    <section class="section">
        <div class="callout">
            <p>Un projet de marque à faire naître ?</p>
            <a class="button" href="{{ route_ts('contact', ['locale' => app()->getLocale()]) }}">Parlons-en</a>
        </div>
    </section>

</div>
@endsection
