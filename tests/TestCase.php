<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * The base implementation strips trailing slashes, which this site's URLs
     * rely on — without this override every test request would hit the
     * EnsureTrailingSlash redirect instead of the page under test.
     */
    protected function prepareUrlForRequest($uri)
    {
        $hasTrailingSlash = is_string($uri) && $uri !== '/' && str_ends_with($uri, '/');

        $prepared = parent::prepareUrlForRequest($uri);

        return $hasTrailingSlash ? $prepared.'/' : $prepared;
    }
}
