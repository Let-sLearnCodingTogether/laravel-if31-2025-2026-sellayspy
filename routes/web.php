<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/{nama}', function(string $nama) {
    return view('halo', compact('nama'));
});
