@extends('layouts.site')

@section('title', "Distribution et promotion de marques d'apéritif — FAR")
@section('meta_description', "FAR distribue des produits via ses propres canaux et conçoit des solutions de promotion et d'activation événementielle.")

@section('content')
<div class="wrap">

    <section class="section">
        <p class="section-label">Nos activités</p>
        <h1 class="page-title">Faire vivre une marque, au-delà du produit</h1>
    </section>

    <section class="section prose">
        <p>Un bon produit ne suffit pas s'il ne rencontre personne. FAR met à disposition ses propres canaux de distribution pour faire circuler les marques qu'elle développe ou accompagne, et conçoit des solutions de promotion et des activations événementielles qui donnent à un produit l'occasion d'être découvert, goûté, et adopté.</p>
    </section>

    <x-media name="distribution-et-promotion" shape="wide" alt="Activation événementielle menée par Fabriques d'Apéro Réunies" class="section" />

    <section class="section">
        <div class="callout">
            <p>Un produit à faire circuler ou à faire découvrir ?</p>
            <a class="button" href="{{ route_ts('contact', ['locale' => app()->getLocale()]) }}">Parlons-en</a>
        </div>
    </section>

</div>
@endsection
