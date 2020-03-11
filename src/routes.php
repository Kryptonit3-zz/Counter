<?php

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::group(['middleware' => ['web']], function () {
    if (Cookie::get(env('COUNTER_COOKIE', 'kryptonit3-counter')) == false) {
        Cookie::queue(env('COUNTER_COOKIE', 'kryptonit3-counter'), Str::random(80), 2628000); // Forever aka 5 years
    }
});
