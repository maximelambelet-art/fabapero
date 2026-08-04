<?php

namespace Tests\Feature;

use App\Mail\ContactMessageMail;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class SiteTest extends TestCase
{
    public static function pageProvider(): array
    {
        return [
            ['/fr/'],
            ['/fr/qui-sommes-nous/'],
            ['/fr/nos-activites/'],
            ['/fr/nos-activites/creation-de-marques/'],
            ['/fr/nos-activites/recettes-et-produits/'],
            ['/fr/nos-activites/low-et-sans-alcool/'],
            ['/fr/nos-activites/distribution-et-promotion/'],
            ['/fr/services/'],
            ['/fr/actualites/'],
            ['/fr/contact/'],
            ['/fr/mentions-legales/'],
            ['/fr/politique-de-confidentialite/'],
            ['/sitemap.xml'],
        ];
    }

    #[DataProvider('pageProvider')]
    public function test_page_is_reachable(string $path): void
    {
        $this->get($path)->assertOk();
    }

    public function test_root_redirects_to_default_locale(): void
    {
        $this->get('/')->assertRedirect('/fr/');
    }

    public function test_url_without_trailing_slash_redirects(): void
    {
        $this->get('/fr/contact')->assertRedirect('/fr/contact/');
    }

    public function test_unknown_locale_returns_404(): void
    {
        $this->get('/it/')->assertNotFound();
    }

    #[DataProvider('draftLocaleProvider')]
    public function test_draft_locale_is_reachable_but_not_indexable(string $locale): void
    {
        $this->get("/{$locale}/")
            ->assertOk()
            ->assertSee('content="noindex, nofollow"', false);
    }

    public static function draftLocaleProvider(): array
    {
        return [['de'], ['en']];
    }

    public function test_published_locale_is_indexable(): void
    {
        $this->get('/fr/')->assertDontSee('noindex', false);
    }

    public function test_sitemap_excludes_draft_locales(): void
    {
        $sitemap = $this->get('/sitemap.xml')->assertOk()->getContent();

        foreach (config('site.draft_locales') as $locale) {
            $this->assertStringNotContainsString("/{$locale}/", $sitemap);
        }
    }

    public function test_hreflang_only_announces_published_locales(): void
    {
        config(['site.show_draft_locales' => true]);

        $html = $this->get('/fr/')->assertOk()->getContent();

        // Only <link rel="alternate"> in the head is the search-engine signal.
        // The switcher's anchors also carry hreflang, which merely describes
        // the language of what they link to, so the check has to be specific.
        foreach (config('site.draft_locales') as $locale) {
            $this->assertStringNotContainsString(
                '<link rel="alternate" hreflang="'.$locale.'"',
                $html
            );
        }
    }

    public function test_every_locale_translates_the_home_page(): void
    {
        foreach (array_merge(config('site.active_locales'), config('site.draft_locales')) as $locale) {
            $html = $this->get("/{$locale}/")->assertOk()->getContent();

            // An untranslated key renders as the raw dot-path.
            $this->assertDoesNotMatchRegularExpression('/pages\.[a-z_]+\./', $html, "Clé non traduite en {$locale}");
        }
    }

    public function test_unknown_activity_slug_returns_404(): void
    {
        $this->get('/fr/nos-activites/inconnu/')->assertNotFound();
    }

    public function test_contact_form_sends_mail(): void
    {
        Mail::fake();

        $this->post('/fr/contact/', [
            'name' => 'Jean Testeur',
            'email' => 'jean@example.com',
            'message' => 'Bonjour, je souhaite discuter d\'un projet.',
        ])->assertRedirect();

        Mail::assertSent(ContactMessageMail::class);
    }

    public function test_contact_form_requires_all_fields(): void
    {
        $this->post('/fr/contact/', [])
            ->assertSessionHasErrors(['name', 'email', 'message']);
    }

    /**
     * Errors surviving in the session is not enough: an intermediate redirect
     * once consumed them, leaving the visitor on a blank form with no reason
     * given. This follows the redirect and reads the rendered page.
     */
    public function test_validation_errors_are_shown_on_the_page(): void
    {
        $this->followingRedirects()
            ->post('/fr/contact/', [])
            ->assertOk()
            ->assertSee(__('contact.name.required'))
            ->assertSee(__('contact.email.required'));
    }

    public function test_success_message_is_shown_on_the_page(): void
    {
        Mail::fake();

        $this->followingRedirects()
            ->post('/fr/contact/', [
                'name' => 'Jean Testeur',
                'email' => 'jean@example.com',
                'message' => 'Bonjour.',
            ])
            ->assertOk()
            ->assertSee(__('pages.contact.sent'));
    }

    public function test_honeypot_blocks_mail_but_looks_successful(): void
    {
        Mail::fake();

        $this->post('/fr/contact/', [
            'name' => 'Spam Bot',
            'email' => 'spam@example.com',
            'message' => 'Spam',
            'website' => 'http://spam.example',
        ])->assertRedirect();

        Mail::assertNothingSent();
    }

    public function test_language_switcher_keeps_the_visitor_on_the_same_page(): void
    {
        config(['site.show_draft_locales' => true]);

        $html = $this->get('/fr/nos-activites/low-et-sans-alcool/')->assertOk()->getContent();

        foreach (['de', 'en'] as $locale) {
            $this->assertStringContainsString(
                "/{$locale}/nos-activites/low-et-sans-alcool/",
                $html
            );
        }
    }

    /**
     * Blog slugs are per-language, so an article with no counterpart must fall
     * back to that locale's index rather than link the visitor to a 404.
     */
    public function test_language_switcher_falls_back_for_untranslated_articles(): void
    {
        config(['site.show_draft_locales' => true]);

        $slug = 'cocktails-sans-alcool-evenements';

        $html = $this->get("/fr/actualites/{$slug}/")->assertOk()->getContent();

        $this->assertStringContainsString('/de/actualites/', $html);
        $this->assertStringNotContainsString("/de/actualites/{$slug}/", $html);
    }

    public function test_language_switcher_hides_drafts_by_default(): void
    {
        config(['site.show_draft_locales' => false]);

        $this->assertSame(config('site.active_locales'), switchable_locales());

        // With a single locale there is nothing to switch between, so the
        // control should not be rendered at all.
        $this->get('/fr/')->assertDontSee('lang-switch', false);
    }

    public function test_security_headers_are_present(): void
    {
        $this->get('/fr/')
            ->assertHeader('X-Content-Type-Options', 'nosniff')
            ->assertHeader('X-Frame-Options', 'DENY');
    }
}
