<?php

namespace App\Support\Blog;

use Carbon\Carbon;
use League\CommonMark\CommonMarkConverter;
use Symfony\Component\Yaml\Yaml;

class BlogRepository
{
    public function all(string $locale): array
    {
        $directory = resource_path("content/blog/{$locale}");

        if (! is_dir($directory)) {
            return [];
        }

        $posts = [];

        foreach (glob($directory.'/*.md') as $file) {
            $posts[] = $this->parse($file);
        }

        usort($posts, fn (BlogPost $a, BlogPost $b) => $b->date <=> $a->date);

        return $posts;
    }

    public function find(string $locale, string $slug): ?BlogPost
    {
        $file = resource_path("content/blog/{$locale}/{$slug}.md");

        return is_file($file) ? $this->parse($file) : null;
    }

    private function parse(string $file): BlogPost
    {
        $raw = file_get_contents($file);

        [$frontMatter, $body] = $this->splitFrontMatter($raw);

        $converter = new CommonMarkConverter;

        return new BlogPost(
            slug: pathinfo($file, PATHINFO_FILENAME),
            title: $frontMatter['title'],
            metaDescription: $frontMatter['meta_description'],
            date: Carbon::parse($frontMatter['date']),
            excerpt: $frontMatter['excerpt'],
            bodyHtml: (string) $converter->convert(trim($body)),
        );
    }

    private function splitFrontMatter(string $raw): array
    {
        if (! str_starts_with($raw, '---')) {
            throw new \RuntimeException('Blog post is missing YAML front matter.');
        }

        $parts = explode('---', $raw, 3);

        return [Yaml::parse($parts[1]), $parts[2] ?? ''];
    }
}
