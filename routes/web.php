<?php


use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/front-end/web.php';
require __DIR__ . '/dashboard/web.php';

//create symbolic link
Route::get('/sym', function () {

    symlink('/home/gsminter/public_html/storage/app/public', '/home/gsminter/public_html/public/storage');
    dd('Symlink created successfully.');
});

Route::get('/artisan/cache', function () {

    // Run the Artisan commands
    Artisan::call('config:cache');
    Artisan::call('route:cache');
    Artisan::call('view:cache');

    // Return a response
    return response()->json([
        'message' => 'Cache commands executed successfully.',
        'config_cache' => Artisan::output(),
        'route_cache' => Artisan::output(),
        'view_cache' => Artisan::output(),
    ]);
});

