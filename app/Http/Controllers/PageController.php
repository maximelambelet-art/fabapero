<?php

namespace App\Http\Controllers;

use App\Support\Blog\BlogRepository;
use Illuminate\View\View;

class PageController extends Controller
{
    public const ACTIVITY_SLUGS = [
        'creation-de-marques',
        'recettes-et-produits',
        'low-et-sans-alcool',
        'distribution-et-promotion',
    ];

    public function __construct(private readonly BlogRepository $blog) {}

    public function home(): View
    {
        return view('pages.home', [
            'recentPosts' => array_slice($this->blog->all(app()->getLocale()), 0, 3),
        ]);
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function activitiesIndex(): View
    {
        return view('pages.activities');
    }

    public function activitiesShow(string $locale, string $slug): View
    {
        abort_unless(in_array($slug, self::ACTIVITY_SLUGS, true), 404);

        return view('pages.activity', ['slug' => $slug]);
    }

    public function services(): View
    {
        return view('pages.services');
    }

    public function legal(): View
    {
        return view('pages.legal');
    }

    public function privacy(): View
    {
        return view('pages.privacy');
    }
}
