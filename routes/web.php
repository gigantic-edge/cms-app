<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
 

Route::match('/', function () {
    return view('welcome');
});