<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Volt::route('index', 'pages.front-end.index')
        ->name('front-end.index');

    Volt::route('about-us', 'pages.front-end.about-us')
        ->name('front-end.about-us');

    Volt::route('contact', 'pages.front-end.contact')
        ->name('frontend.contact');

    Volt::route('product-details', 'pages.front-end.product-details')
        ->name('front-end.product-details');

    Volt::route('shop-grid', 'pages.front-end.shop-grid')
        ->name('front-end.shop-grid');

    Volt::route('search', 'pages.front-end.search')
        ->name('front-end.search');

    Volt::route('wishlist', 'pages.front-end.wishlist')
        ->name('front-end.wishlist');

    Volt::route('thank-you', 'pages.front-end.thank-you')
        ->name('front-end.thank-you');
});
