<?php

namespace App\Http\Controllers;

use App\Support\Blog\BlogRepository;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function __construct(private readonly BlogRepository $blog) {}

    public function index(): View
    {
        return view('blog.index', [
            'posts' => $this->blog->all(app()->getLocale()),
        ]);
    }

    public function show(string $locale, string $slug): View
    {
        $post = $this->blog->find($locale, $slug);

        abort_unless($post, 404);

        return view('blog.show', ['post' => $post]);
    }
}
