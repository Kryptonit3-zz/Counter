<?php

Route::group(['middleware' => ['web']], function () {
    if (Cookie::get('kryptonit3-counter') == false) {
        Cookie::queue('kryptonit3-counter', str_random(80), 2628000); // Forever aka 5 years
    }
});
