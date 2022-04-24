<?php

use Simpler\Components\Http\Routers\Route;

// Hello world
Route::api([
    'uri' => '/hello',
    'name' => 'hello',
], static function () {
    return 'Hello world!';
});

// Render view
Route::render();

// 404 - Not Found
Route::routeNotFound();
