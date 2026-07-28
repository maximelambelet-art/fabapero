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
