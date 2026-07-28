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

    public function test_inactive_locale_returns_404(): void
    {
        $this->get('/de/')->assertNotFound();
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

    public function test_security_headers_are_present(): void
    {
        $this->get('/fr/')
            ->assertHeader('X-Content-Type-Options', 'nosniff')
            ->assertHeader('X-Frame-Options', 'DENY');
    }
}
