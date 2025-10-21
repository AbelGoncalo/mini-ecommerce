<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
    'auth.redirect' => \App\Http\Middleware\AuthRedirect::class,
    'auth' => \App\Http\Middleware\Authenticate::class,
];

}
