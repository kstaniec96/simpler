<?php

declare(strict_types=1);

namespace Project\Http\Controllers;

use Simpler\Components\Http\BaseController;

class HelloController extends BaseController
{
    public function index(): string
    {
        return $this->render('hello');
    }
}
