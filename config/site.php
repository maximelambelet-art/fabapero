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

    // Whether the language switcher offers the drafts as well. Off by default
    // so a real prospect is never walked into an unreviewed translation; turn
    // it on (including in production) while the client proof-reads.
    'show_draft_locales' => (bool) env('SHOW_DRAFT_LOCALES', false),

    'default_locale' => 'fr',

    // Open Graph wants language_TERRITORY, not a bare language code.
    'og_locales' => [
        'fr' => 'fr_CH',
        'de' => 'de_CH',
        'en' => 'en_GB',
    ],

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
