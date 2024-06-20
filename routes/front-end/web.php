<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::name('front-end.')->group(function () {
    Volt::route('/', 'pages.front-end.index')
        ->name('index');

    Volt::route('index', 'pages.front-end.index')
        ->name('index');

    Volt::route('about-us', 'pages.front-end.about-us')
        ->name('about-us');

    Volt::route('contact', 'pages.front-end.contact')
        ->name('contact');

    Volt::route('product-details', 'pages.front-end.product-details')
        ->name('product-details');

    Volt::route('shop-grid', 'pages.front-end.shop-grid')
        ->name('shop-grid');

    Volt::route('search', 'pages.front-end.search')
        ->name('search');

    Volt::route('wishlist', 'pages.front-end.wishlist')
        ->name('wishlist');

    Volt::route('thank-you', 'pages.front-end.thank-you')
        ->name('thank-you');
});
