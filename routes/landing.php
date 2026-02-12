<?php

use Inertia\Inertia;


Route::get('/', function () {
    return Inertia::render('Index');
});

Route::get("/about", function () {
    return Inertia::render('About');
});

Route::get('/services', function () {
    return Inertia::render('Service');
});

Route::get('/contact', function () {
    return Inertia::render('Contact');
});