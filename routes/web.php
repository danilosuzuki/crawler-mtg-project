<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\CommanderController;
use App\Http\Controllers\ScrapeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/commanders', [CommanderController::class, 'indexWeb']);

// Route::get('/scrape', [ScrapeController::class, 'scrape']);

Route::get('/cards/{name}', [CardController::class, 'showWeb']);

