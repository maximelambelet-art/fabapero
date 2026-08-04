@extends('layouts.site')

@section('title', "Qui sommes-nous — Fabriques d'Apéro Réunies")
@section('meta_description', "L'histoire de Maxime Lambelet, fondateur de FAR : de la première limonaderie artisanale du canton de Neuchâtel à la création de cocktails sans alcool.")

@section('content')
<div class="wrap">

    <section class="section">
        <h1 class="page-title">Qui sommes-nous</h1>
    </section>

    <section @class(['section', 'feature', 'feature--with-media' => site_image('fondateur-portrait')])>
        <x-media name="fondateur-portrait" shape="portrait" alt="Maxime Lambelet, fondateur de Fabriques d'Apéro Réunies" />

        <div class="prose">
            <p>Tout commence en 2019, dans le canton de Neuchâtel, avec la conviction qu'on peut boire mieux sans renoncer au plaisir : je fonde Kinaï, la première limonaderie artisanale du canton, avec l'envie de partager des boissons régionales, artisanales et moins sucrées. De la recette à la mise en bouteille, je maîtrise toute la chaîne — y compris les machines que je conçois moi-même pour produire exactement ce que j'imagine.</p>

            <p>En 2024, une opportunité se présente : je cède Kinaï et me lance dans un nouveau défi, Kobiji, une marque de cocktails sans alcool à base de produits désalcoolisés qui conservent le goût des spiritueux, sans l'alcool. Passionné de technologie, je me forme en continu et je maîtrise tout le parcours d'un produit — de la conception à la mise sur le marché. Plus de 10 produits ont déjà vu le jour et trouvé leur place en Suisse.</p>

            <x-media name="fabrication-1" shape="wide" alt="Machine de production conçue par Fabriques d'Apéro Réunies" />

            <p>Cette expérience, ce nez fin pour les tendances et ce savoir-faire technique, notamment dans l'événementiel, sont aujourd'hui ce que Fabriques d'Apéro Réunies met au service des brasseurs et des vignerons — et plus largement de tout entrepreneur, marque ou producteur de boisson — qui veulent réussir, eux aussi, leur virage vers le low et le sans alcool.</p>
        </div>
    </section>

    <section class="section">
        <div class="callout">
            <p>Un projet de marque, de recette ou de virage vers le low et le sans alcool ?</p>
            <a class="button" href="{{ route_ts('contact', ['locale' => app()->getLocale()]) }}">Parlons-en</a>
        </div>
    </section>

</div>
@endsection
