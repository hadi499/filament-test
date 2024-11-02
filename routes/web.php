<?php

use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\Score;
use App\Livewire\Tests;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogoutController;

Route::middleware(['auth'])->group(function () {

    Route::get('/', Home::class)->name('home');
    Route::get('/tests', Tests::class)->name('tests');
    Route::get('/score', Score::class)->name('score');
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});


Route::get('/login', Login::class)->name('login');
