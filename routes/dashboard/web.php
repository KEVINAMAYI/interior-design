<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Volt::route('admin', 'pages.dashboard.index')
        ->name('dashboard.index');
});