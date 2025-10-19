<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.index');
});

Route::get('/campaigns', function () {
    return view('campaigns');
});

Route::get('/automation', function () {
    return view('automation');
});

Route::get('/audience', function () {
    return view('audience');
});

Route::get('audience/inbox', function () {
    return view('inbox');
});