<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware(['auth', 'verified'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Volt::route('/index', 'pages.dashboard.index')
        ->name('index');

    Volt::route('profile', 'pages.dashboard.profile')
        ->name('profile');
});
