<?php

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
