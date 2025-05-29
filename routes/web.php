<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/contact', [PortfolioController::class, 'contact'])->name('portfolio.contact');
Route::get('/about', [PortfolioController::class, 'about'])->name('portfolio.about');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/test-upload', function() {
    return view('test-upload');
});

Route::post('/test-upload', function() {
    request()->file('file')->store('test', 'public');
    return 'Upload berhasil';
});