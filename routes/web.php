<?php


use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/front-end/web.php';
require __DIR__ . '/dashboard/web.php';

//create symbolic link
Route::get('/symbolic-link', function () {
    Artisan::call('symbolic:link');
})->name('symbolic-link');

