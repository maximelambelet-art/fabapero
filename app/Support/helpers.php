<?php

use App\Support\Blog\BlogRepository;
use Illuminate\Support\Facades\Route;

if (! function_exists('route_ts')) {
    /**
     * Laravel's route()/url() helpers always strip trailing slashes from
     * generated URLs, but this site's URL scheme (validated with the
     * client) uses one on every content page. This wraps route() to add
     * it back consistently, so internal links don't trigger a 301 redirect
     * through EnsureTrailingSlash on every click.
     */
    function route_ts(string $name, array $parameters = []): string
    {
        return rtrim(route($name, $parameters), '/').'/';
    }
}

if (! function_exists('switchable_locales')) {
    /**
     * Locales the language switcher may offer.
     *
     * Drafts are left out unless SHOW_DRAFT_LOCALES is on: they carry noindex
     * so search engines skip them, but a visible link would still walk a real
     * prospect into a translation nobody has proof-read yet. Turning the flag
     * on is how the client reviews them, locally or on the deployed site.
     */
    function switchable_locales(): array
    {
        $locales = config('site.active_locales');

        if (config('site.show_draft_locales')) {
            $locales = array_merge($locales, config('site.draft_locales'));
        }

        return $locales;
    }
}

if (! function_exists('locale_url')) {
    /**
     * The current page in another locale.
     *
     * Blog slugs are per-language, so an article has no counterpart in a
     * locale that has not translated it — falling back to that locale's blog
     * index beats sending the visitor to a 404.
     */
    function locale_url(string $locale): string
    {
        $route = Route::currentRouteName();
        $parameters = request()->route()?->parameters() ?? [];

        if ($route === 'news.show') {
            $exists = app(BlogRepository::class)
                ->find($locale, $parameters['slug'] ?? '');

            if (! $exists) {
                return route_ts('news.index', ['locale' => $locale]);
            }
        }

        if (! $route) {
            return route_ts('home', ['locale' => $locale]);
        }

        return route_ts($route, array_merge($parameters, ['locale' => $locale]));
    }
}

if (! function_exists('site_image')) {
    /**
     * Resolve a reserved image slot to its file, or null while none exists.
     *
     * Pages call this to lay themselves out: a slot that is still empty must
     * not leave a gap where the photo will one day go, so the layout has to
     * know the difference rather than assume the image is always there.
     */
    function site_image(string $name): ?string
    {
        foreach (['jpg', 'jpeg', 'png', 'webp'] as $extension) {
            $relative = 'img/site/'.$name.'.'.$extension;

            if (is_file(public_path($relative))) {
                return $relative;
            }
        }

        return null;
    }
}
