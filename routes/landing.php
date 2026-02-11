<?php

use Inertia\Inertia;


Route::get('/', function () {
    return Inertia::render('Index');
});

Route::get("/about", function () {
    return Inertia::render('About');
});