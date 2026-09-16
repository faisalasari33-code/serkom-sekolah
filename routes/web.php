<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return view('layouts.admin');
});
