<?php

declare(strict_types=1);

use Simpler\Components\Http\Routers\Route;

// Hello world
Route::api([
    'uri' => '/hello',
    'name' => 'hello',
], static function () {
    return response()->json('Hello world');
});
