<?php

namespace App\Http\Controllers;

use App\Support\Blog\BlogRepository;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    private const STATIC_PAGES = [
        'home',
        'about',
        'activities.index',
        'services',
        'news.index',
        'contact',
        'legal',
        'privacy',
    ];

    private const ACTIVITY_SLUGS = [
        'creation-de-marques',
        'recettes-et-produits',
        'low-et-sans-alcool',
        'distribution-et-promotion',
    ];

    public function index(BlogRepository $blog): Response
    {
        $urls = [];

        foreach (config('site.active_locales') as $locale) {
            foreach (self::STATIC_PAGES as $routeName) {
                $urls[] = route_ts($routeName, ['locale' => $locale]);
            }

            foreach (self::ACTIVITY_SLUGS as $slug) {
                $urls[] = route_ts('activities.show', ['locale' => $locale, 'slug' => $slug]);
            }

            foreach ($blog->all($locale) as $post) {
                $urls[] = route_ts('news.show', ['locale' => $locale, 'slug' => $post->slug]);
            }
        }

        $urls = array_unique($urls);

        $xml = new \SimpleXMLElement('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"/>');

        foreach ($urls as $url) {
            $xml->addChild('url')->addChild('loc', htmlspecialchars($url));
        }

        return response($xml->asXML(), 200)->header('Content-Type', 'application/xml');
    }
}
