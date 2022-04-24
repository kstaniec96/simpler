<?php

namespace Simpler\Components\Interfaces;

use Simpler\Components\Enums\HttpStatus;

interface BaseControllerInterface
{
    /**
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render(string $view, array $params = []): string;

    /**
     * @param string $view
     * @param string $blockName
     * @param array $params
     * @return string
     */
    public function renderBlock(string $view, string $blockName, array $params = []): string;

    /**
     * @param mixed $data
     * @param int $status
     * @return string
     */
    public function json($data = null, int $status = HttpStatus::OK): string;

    /**
     * @param mixed $error
     * @return void
     */
    public function error($error = null): void;
}
