<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;



require __DIR__ .'/auth/routes.php';
require __DIR__ .'/admin/routes.php';
require __DIR__ .'/client/routes.php';
require __DIR__ .'/site/routes.php';

Route::get('/senha', function() {
    return Hash::make('12345678');
});


