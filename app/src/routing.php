<?php

use Simpler\Components\Http\Routers\Route;

/***** Import routes *****/
import(ROUTES_PATH.DS.'web.php');
import(ROUTES_PATH.DS.'api.php');

/***** Render views *****/
Route::render();

/***** 404 - Not found *****/
Route::routeNotFound('404.html');
