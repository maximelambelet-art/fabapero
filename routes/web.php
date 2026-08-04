<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

// Route::redirect() normalizes away trailing slashes via the URL
// generator, so the target is built as a raw response instead.
Route::get('/', function () {
    return response('', 301)->header('Location', '/'.config('site.default_locale').'/');
});

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Draft locales are routable so they can be proof-read; the layout marks
// them noindex and the sitemap ignores them until they are published.
$servedLocales = implode('|', array_map(
    'preg_quote',
    array_merge(config('site.active_locales'), config('site.draft_locales'))
));

Route::middleware(['locale'])->where(['locale' => $servedLocales])->group(function () {
    Route::get('/{locale}/', [PageController::class, 'home'])->name('home');
    Route::get('/{locale}/qui-sommes-nous/', [PageController::class, 'about'])->name('about');
    Route::get('/{locale}/nos-activites/', [PageController::class, 'activitiesIndex'])->name('activities.index');
    Route::get('/{locale}/nos-activites/{slug}/', [PageController::class, 'activitiesShow'])->name('activities.show');
    Route::get('/{locale}/services/', [PageController::class, 'services'])->name('services');
    Route::get('/{locale}/actualites/', [BlogController::class, 'index'])->name('news.index');
    Route::get('/{locale}/actualites/{slug}/', [BlogController::class, 'show'])->name('news.show');
    Route::get('/{locale}/contact/', [ContactController::class, 'show'])->name('contact');
    Route::post('/{locale}/contact/', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/{locale}/mentions-legales/', [PageController::class, 'legal'])->name('legal');
    Route::get('/{locale}/politique-de-confidentialite/', [PageController::class, 'privacy'])->name('privacy');
});
