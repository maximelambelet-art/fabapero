<?php

return [
    // Published locales: routed, announced through hreflang, and listed in
    // the sitemap. Moving a locale from draft_locales to here is the single
    // switch that puts a language live.
    'active_locales' => ['fr'],

    // Reachable by typing the URL, so the client can proof-read them, but
    // kept out of the sitemap and hreflang and served with noindex — a
    // half-reviewed translation must not reach search results.
    'draft_locales' => ['de', 'en'],

    'default_locale' => 'fr',

    'name' => 'Fabriques d\'Apéro Réunies',

    'legal_name' => 'Fabriques d\'apéro réunies Sàrl',

    'email' => 'hello@fabapero.ch',

    'phone' => '+41 78 339 32 34',

    'address' => [
        'street' => 'Chemin des Prés-Verts 12',
        'postal_code' => '2300',
        'city' => 'La Chaux-de-Fonds',
        'country' => 'CH',
    ],
];
