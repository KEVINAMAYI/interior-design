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

    /**
     * Staff Routes
     */
    Volt::route('list-staff', 'pages.dashboard.staff.list-staff')
        ->name('list-staff');

    Volt::route('add-staff', 'pages.dashboard.staff.add-staff')
        ->name('add-staff');

    /**
     * Customer Routes
     */
    Volt::route('list-customers', 'pages.dashboard.customers.list-customers')
        ->name('list-customers');

    Volt::route('add-customer', 'pages.dashboard.customers.add-customer')
        ->name('add-customer');

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

    /**
     * Deals Routes
     */
    Volt::route('list-deals', 'pages.dashboard.deals.list-deals')
        ->name('list-deals');

    Volt::route('add-deal', 'pages.dashboard.deals.add-deal')
        ->name('add-deal');

});
