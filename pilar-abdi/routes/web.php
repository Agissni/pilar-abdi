<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/program', function () {
    return view('program');
});

Route::get('/pendaftaran', function () {
    return view('pendaftaran');
});