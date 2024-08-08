<?php


use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/front-end/web.php';
require __DIR__ . '/dashboard/web.php';

//create symbolic link
Route::get('/sym', function () {

    symlink('/home/gsminter/public_html/storage/app/public', '/home/gsminter/public_html/public/storage');
    dd('Symlink created successfully.');

});

