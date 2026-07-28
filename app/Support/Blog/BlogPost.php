<?php

namespace App\Support\Blog;

use Carbon\Carbon;

class BlogPost
{
    public function __construct(
        public readonly string $slug,
        public readonly string $title,
        public readonly string $metaDescription,
        public readonly Carbon $date,
        public readonly string $excerpt,
        public readonly string $bodyHtml,
    ) {}
}
