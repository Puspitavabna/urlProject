<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/short-url', [UrlController::class, 'createShortUrl']); // POST to create short URL
Route::get('/{shortUrl}', [UrlController::class, 'redirectToOriginalUrl']); // GET to redirect to original URL
Route::get('/', [UrlController::class, 'showForm']);