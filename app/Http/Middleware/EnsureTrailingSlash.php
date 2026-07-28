<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTrailingSlash
{
    private const EXCLUDED_PATHS = ['/up'];

    public function handle(Request $request, Closure $next): Response
    {
        $path = $request->getPathInfo();

        if (
            $path !== '/'
            && ! str_ends_with($path, '/')
            && ! str_contains(basename($path), '.')
            && ! in_array($path, self::EXCLUDED_PATHS, true)
        ) {
            $query = $request->getQueryString();

            // Laravel's redirect()/url() helpers always strip trailing
            // slashes when formatting a URL, which would undo this
            // middleware's purpose — build the response manually instead.
            return response('', 301)->header('Location', $path.'/'.($query ? '?'.$query : ''));
        }

        return $next($request);
    }
}
