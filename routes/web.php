<?php

use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('index');
})->name('home');


Route::get('/f/{short_url}', [FileController::class, 'show']);

Route::post('/d/{short_url}', [FileController::class, 'download']);

Route::post('/upload', [FileController::class, 'store'])->name('upload');
