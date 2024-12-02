<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\CommanderController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\StapleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/staples', [StapleController::class, 'index']);
Route::get('/staple/{perPage}', [StapleController::class, 'paginate']);

Route::get('/commanders', [CommanderController::class, 'index']);
Route::get('/commander/{perPage}', [CommanderController::class, 'paginate']);

Route::get('/cards', [CardController::class, 'index']);
Route::get('/cards/show/{name}', [CardController::class, 'show']);
Route::get('/cards/{perPage}', [CardController::class, 'paginate']);

Route::post('/subscribe', [NewsletterController::class, 'subscribe']);
