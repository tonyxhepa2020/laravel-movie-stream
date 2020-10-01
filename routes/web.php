<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Show\DefaultPageController;
use App\Http\Controllers\Show\EpisodeController;
use App\Http\Livewire\Show\CastIndex;
use App\Http\Livewire\Show\CastShow;
use App\Http\Livewire\Show\EpisodeShow;
use App\Http\Livewire\Show\GenreShow;
use App\Http\Livewire\Show\MovieIndex;
use App\Http\Livewire\Show\MovieShow;
use App\Http\Livewire\Show\SeasonShow;
use App\Http\Livewire\Show\SerieIndex;
use App\Http\Livewire\Show\SerieShow;
use App\Http\Livewire\Show\TagShow;
use App\Http\Livewire\Show\WelcomeMovie;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
//Route::get('/test', [AdminController::class, 'test']);
Route::group([
    'middleware' => ['role:admin'],
    'prefix' => 'admin'
], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/{any}', [AdminController::class, 'index'])->where('any', '.*');
});
Route::get('/', WelcomeMovie::class)->name('welcome');
Route::get('/contact', [DefaultPageController::class, 'contact'])->name('contact');
Route::get('/dmca', [DefaultPageController::class, 'dmca'])->name('dmca');
Route::get('/privacy', [DefaultPageController::class, 'privacy'])->name('privacy');

Route::get('/tags/{slug}', TagShow::class)->name('tags.show');
Route::get('/genres/{slug}', GenreShow::class)->name('genres.show');

Route::get('/aktor', CastIndex::class)->name('casts.index');
Route::get('/aktor/{slug}', CastShow::class)->name('casts.show');

Route::get('/filma', MovieIndex::class)->name('movies.index');
Route::get('/filma/{slug}', MovieShow::class)->name('movies.show');

Route::get('/seriale', SerieIndex::class)->name('series.index');
Route::get('/seriale/{slug}', SerieShow::class)->name('series.show');
Route::get('/serie/{serie}/season/{season}', SeasonShow::class)->name('seasons.show');
Route::get('/episodes/{slug}', EpisodeShow::class)->name('episodes.show');


