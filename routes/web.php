<?php

use Project\Http\Controllers\HelloController;
use Simpler\Components\Http\Routers\Route;

// Hello
Route::web([
    'uri' => '/',
    'name' => 'hello',
], [HelloController::class, 'index']);

/***** Render view *****/
Route::render();

/***** 404 - Not found *****/
Route::routeNotFound('404.html');
