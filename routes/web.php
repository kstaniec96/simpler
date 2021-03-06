<?php

declare(strict_types=1);

use Project\Http\Controllers\HelloController;
use Simpler\Components\Http\Routers\Route;

// Hello
Route::web([
    'uri' => '/',
    'name' => 'hello',
], [HelloController::class, 'index']);
