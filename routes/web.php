<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/tinker', function () {
    //
});

Route::get('/', function () {
    if (App::environment(['local'])) {
        Auth::loginUsingId(1);
    }

    return to_route('filament.app.auth.login');
});

Route::get('/login', function () {
    return to_route('filament.app.auth.login');
})->name('login');
