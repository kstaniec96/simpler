<?php

namespace Simpler\Components\Requests\Interfaces;

use Simpler\Components\Enums\HttpStatus;
use Simpler\Components\Requests\Redirect;

interface RedirectInterface
{
    /**
     * @param string $to
     * @param int $code
     * @param string|null $message
     * @return void
     */
    public function to(string $to = '/', int $code = HttpStatus::FOUND, ?string $message = null): void;

    /**
     * @param string $status
     * @param string $message
     * @return Redirect
     */
    public function with(string $status, string $message): Redirect;
}
