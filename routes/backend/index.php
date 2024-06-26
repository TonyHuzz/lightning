<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    foreach (glob(__DIR__ . '/auth/*.php') as $routeFile) {
        require $routeFile;
    }
});
