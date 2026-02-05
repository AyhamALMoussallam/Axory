<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('index/', function () {
    return view('index');
});

Route::get('portfolio/', function () {
    return view('portfolio-details');
});

Route::get('service/', function () {
    return view('service-details');
});

Route::get('starter/', function () {
    return view('starter-page');
});
