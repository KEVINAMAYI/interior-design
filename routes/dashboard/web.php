<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware(['auth', 'verified'])->prefix('dashboard')->name('dashboard.')->group(function () {

    Volt::route('/index', 'pages.dashboard.index')
        ->name('index');

    Volt::route('profile', 'pages.dashboard.profile')
        ->name('profile');

    /**
     * Products Routes
     */
    Volt::route('list-products', 'pages.dashboard.products.list-products')
        ->name('list-products');

    Volt::route('add-product', 'pages.dashboard.products.add-product')
        ->name('add-product');

    Volt::route('edit-product/{product_variation_id}', 'pages.dashboard.products.edit-product')
        ->name('edit-product');


    /**
     * Product Categories Routes
     */
    Volt::route('list-categories', 'pages.dashboard.product-categories.list-product-categories')
        ->name('list-categories');

    Volt::route('add-category', 'pages.dashboard.product-categories.add-product-category')
        ->name('add-category');

    Volt::route('edit-category/{category_id}', 'pages.dashboard.product-categories.edit-product-category')
        ->name('edit-category');

    /**
     * Variations Routes
     */
    Volt::route('list-variations', 'pages.dashboard.variations.list-variations')
        ->name('list-variations');

    Volt::route('add-variation', 'pages.dashboard.variations.add-variation')
        ->name('add-variation');

    Volt::route('edit-variation/{variation_id}', 'pages.dashboard.variations.edit-variation')
        ->name('edit-variation');

    /**
     * Staff Routes
     */
    Volt::route('list-staff', 'pages.dashboard.staff.list-staff')
        ->name('list-staff');

    Volt::route('add-staff', 'pages.dashboard.staff.add-staff')
        ->name('add-staff');

    Volt::route('edit-staff/{user_id}', 'pages.dashboard.staff.edit-staff')
        ->name('edit-staff');


    /**
     * Portfolio Routes
     */
    Volt::route('list-portfolio', 'pages.dashboard.portfolio.list-portfolio')
        ->name('list-portfolio');

    Volt::route('add-portfolio', 'pages.dashboard.portfolio.add-portfolio')
        ->name('add-portfolio');

    Volt::route('edit-portfolio/{portfolio_id}', 'pages.dashboard.portfolio.edit-portfolio')
        ->name('edit-portfolio');


    /**
     * CallBacks Routes
     */
    Volt::route('list-callbacks', 'pages.dashboard.callbacks.list-callbacks')
        ->name('list-callbacks');


    /**
     * Roles Routes
     */
    Volt::route('list-roles', 'pages.dashboard.roles.list-roles')
        ->name('list-roles');

    Volt::route('add-role', 'pages.dashboard.roles.add-role')
        ->name('add-role');


});
