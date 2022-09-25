<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    echo env('APP_NAME') . ' ' . env('APP_VERSION') . ' ' . env('APP_ENV');
});
