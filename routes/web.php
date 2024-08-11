<?php


use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/front-end/web.php';
require __DIR__ . '/dashboard/web.php';

//create symbolic link
Route::get('/storage-link', function () {
    Artisan::call('storage:link');
})->name('storage-link');

