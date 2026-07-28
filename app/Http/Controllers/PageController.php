<?php

namespace App\Http\Controllers;

use App\Support\Blog\BlogRepository;
use Illuminate\Support\Facades\View;
use Illuminate\View\View as ViewContract;

class PageController extends Controller
{
    private const ACTIVITY_SLUGS = [
        'creation-de-marques',
        'recettes-et-produits',
        'low-et-sans-alcool',
        'distribution-et-promotion',
    ];

    public function __construct(private readonly BlogRepository $blog) {}

    public function home(): ViewContract
    {
        return view('pages.'.app()->getLocale().'.home', [
            'recentPosts' => array_slice($this->blog->all(app()->getLocale()), 0, 3),
        ]);
    }

    public function about(): ViewContract
    {
        return $this->render('qui-sommes-nous');
    }

    public function activitiesIndex(): ViewContract
    {
        return $this->render('nos-activites.index');
    }

    public function activitiesShow(string $locale, string $slug): ViewContract
    {
        abort_unless(in_array($slug, self::ACTIVITY_SLUGS, true), 404);

        return $this->render('nos-activites.'.$slug);
    }

    public function services(): ViewContract
    {
        return $this->render('services');
    }

    public function legal(): ViewContract
    {
        return $this->render('mentions-legales');
    }

    public function privacy(): ViewContract
    {
        return $this->render('politique-de-confidentialite');
    }

    private function render(string $page): ViewContract
    {
        $view = 'pages.'.app()->getLocale().'.'.$page;

        abort_unless(View::exists($view), 404);

        return view($view);
    }
}
