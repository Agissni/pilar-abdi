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

Route::get('/testimoni', function () {
    return view('testimoni');
});

Route::get('/keunggulan', function () {
    return view('keunggulan');
});

Route::get('/kontak', function () {
    return view('kontak');
});