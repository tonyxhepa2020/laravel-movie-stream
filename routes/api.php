<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ApiAdminCastController;
use App\Http\Controllers\Admin\ApiAdminDownloadController;
use App\Http\Controllers\Admin\ApiAdminEmbedController;
use App\Http\Controllers\Admin\ApiAdminEpisodeController;
use App\Http\Controllers\Admin\ApiAdminGenreController;
use App\Http\Controllers\Admin\ApiAdminMovieController;
use App\Http\Controllers\Admin\ApiAdminSeasonController;
use App\Http\Controllers\Admin\ApiAdminSerieController;
use App\Http\Controllers\Admin\ApiAdminSettingController;
use App\Http\Controllers\Admin\ApiAdminTagController;
use App\Http\Controllers\Admin\ApiAdminTrailerController;
use App\Http\Controllers\Admin\ApiAdminWatchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => ['auth:sanctum','role:admin'],
    'prefix' => 'admin', 'as' => 'admin.'
], function () {
    Route::get('/setting-backup', [ApiAdminSettingController::class, 'backup']);
    Route::get('/setting-inspire', [ApiAdminSettingController::class, 'inspire']);
    Route::get('/setting-optimize', [ApiAdminSettingController::class, 'optimize']);
    Route::get('/setting-sitemap', [ApiAdminSettingController::class, 'sitemap']);
    Route::get('dashboard-users', [AdminController::class, 'users']);
    Route::get('dashboard-movies', [AdminController::class, 'movies']);
    Route::get('dashboard-series', [AdminController::class, 'series']);
    Route::get('dashboard-genres', [AdminController::class, 'genres']);
    Route::get('dashboard-tags', [AdminController::class, 'tags']);
    Route::get('dashboard-casts', [AdminController::class, 'casts']);
    Route::apiResource('/admin-tags', ApiAdminTagController::class);
    Route::apiResource('/admin-casts', ApiAdminCastController::class);
    Route::apiResource('/admin-genres', ApiAdminGenreController::class);
    Route::apiResource('/admin-movies', ApiAdminMovieController::class);
    Route::get('/admin-movies/{movie:slug}/watchUrl', [ApiAdminMovieController::class,'watchUrl']);
    Route::get('/admin-movies/{movie:slug}/downloadUrl', [ApiAdminMovieController::class,'downloadUrl']);
    Route::get('/admin-movies/{movie:slug}/embedUrl',[ApiAdminMovieController::class,'embedUrl']);
    Route::get('/admin-movies/{movie:slug}/trailerUrl', [ApiAdminMovieController::class,'trailerUrl']);
    Route::post('/admin-movies/{movie:slug}/addEmbedUrl', [ApiAdminMovieController::class,'addEmbedUrl']);
    Route::post('/admin-movies/{movie:slug}/addTrailerUrl',[ApiAdminMovieController::class,'addTrailerUrl']);
    Route::post('/admin-movies/{movie:slug}/addWatchUrl', [ApiAdminMovieController::class,'addWatchUrl']);
    Route::post('/admin-movies/{movie:slug}/addDownloadUrl', [ApiAdminMovieController::class,'addDownloadUrl']);
    Route::apiResource('/admin-series', ApiAdminSerieController::class);
    Route::apiResource('/admin-series/{serie_id}/seasons', ApiAdminSeasonController::class);
    Route::apiResource('/admin-series/{serie_id}/seasons/{season_id}/episodes', ApiAdminEpisodeController::class);
    Route::get('/admin-episodes/{episode:slug}/watchUrl', [ApiAdminEpisodeController::class,'watchUrl']);
    Route::get('/admin-episodes/{episode:slug}/downloadUrl', [ApiAdminEpisodeController::class,'downloadUrl']);
    Route::get('/admin-episodes/{episode:slug}/embedUrl', [ApiAdminEpisodeController::class,'embedUrl']);
    Route::post('/admin-episodes/{episode:slug}/addEmbedUrl', [ApiAdminEpisodeController::class,'addEmbedUrl']);
    Route::post('/admin-episodes/{episode:slug}/addWatchUrl', [ApiAdminEpisodeController::class,'addWatchUrl']);
    Route::post('/admin-episodes/{episode:slug}/addDownloadUrl', [ApiAdminEpisodeController::class,'addDownloadUrl']);
    Route::delete('/admin-embed/{embedUrl:id}', [ApiAdminEmbedController::class,'destroy']);
    Route::delete('/admin-watchUrl/{watchUrl:id}', [ApiAdminWatchController::class,'destroy']);
    Route::delete('/admin-download/{downloadUrl:id}', [ApiAdminDownloadController::class,'destroy']);
    Route::delete('/admin-trailer/{trailerUrl:id}', [ApiAdminTrailerController::class,'destroy']);
});
